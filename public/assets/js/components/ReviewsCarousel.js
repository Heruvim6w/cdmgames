export default {
    name: 'ReviewsCarousel',
    props: {
        reviews: {
            type: Array,
            required: true
        }
    },
    data() {
        return {
            animationId: null,
            startTime: null,
            animationDuration: 40000, // 40 секунд
            isPaused: false,
            pausedProgress: 0, // Сохраняем прогресс при паузе
            lastTimestamp: null
        };
    },
    computed: {
        duplicatedReviews() {
            return [...this.reviews, ...this.reviews];
        }
    },
    template: `
        <div class="reviews-carousel-horizontal" @mouseenter="pauseAnimation" @mouseleave="resumeAnimation">
            <div class="carousel-track" ref="track">
                <div
                    v-for="(review, idx) in duplicatedReviews"
                    :key="idx"
                    class="review-card-horizontal"
                >
                    <div class="review-author">
                        {{ review.vk_user_name ?? review.tg_user_name ?? 'Аноним' }}
                    </div>
                    <div class="review-text">
                        {{ review.comment }}
                    </div>
                    <div class="review-date">
                        {{ formatDate(review.created_at) }}
                    </div>
                </div>
            </div>
        </div>
    `,
    methods: {
        formatDate(dateString) {
            return dateString ? dateString.slice(0, 10) : '';
        },

        initCarousel() {
            this.calculateCardWidth();
            this.startAnimation();
            this.addResizeListener();
        },

        calculateCardWidth() {
            const card = this.$el.querySelector('.review-card-horizontal');
            if (card) {
                this.cardWidth = card.offsetWidth + 24; // ширина + margin
            }
        },

        startAnimation() {
            this.startTime = performance.now() - (this.pausedProgress * this.animationDuration);
            this.lastTimestamp = null;
            this.animationId = requestAnimationFrame(this.animate);
        },

        animate(timestamp) {
            if (this.isPaused) return;

            if (!this.lastTimestamp) {
                this.lastTimestamp = timestamp;
            }

            const elapsed = timestamp - this.startTime;
            const progress = (elapsed % this.animationDuration) / this.animationDuration;
            this.pausedProgress = progress; // Сохраняем текущий прогресс

            if (this.$refs.track) {
                const totalWidth = this.cardWidth * this.reviews.length;
                const translateX = -progress * totalWidth;
                this.$refs.track.style.transform = `translateX(${translateX}px)`;
            }

            this.lastTimestamp = timestamp;
            this.animationId = requestAnimationFrame(this.animate);
        },

        pauseAnimation() {
            if (!this.isPaused) {
                this.isPaused = true;
                // Сохраняем текущий прогресс перед паузой
                if (this.lastTimestamp && this.startTime) {
                    const elapsed = this.lastTimestamp - this.startTime;
                    this.pausedProgress = (elapsed % this.animationDuration) / this.animationDuration;
                }
            }
        },

        resumeAnimation() {
            if (this.isPaused) {
                this.isPaused = false;
                // Перезапускаем анимацию с сохраненным прогрессом
                this.startAnimation();
            }
        },

        addResizeListener() {
            this.resizeObserver = new ResizeObserver(this.handleResize);
            this.resizeObserver.observe(this.$el);
        },

        handleResize() {
            this.calculateCardWidth();

            // При изменении размера обновляем позицию с текущим прогрессом
            if (this.$refs.track && !this.isPaused) {
                const elapsed = performance.now() - this.startTime;
                const progress = (elapsed % this.animationDuration) / this.animationDuration;
                const totalWidth = this.cardWidth * this.reviews.length;
                const translateX = -progress * totalWidth;
                this.$refs.track.style.transform = `translateX(${translateX}px)`;
            }
        },

        cleanup() {
            if (this.animationId) {
                cancelAnimationFrame(this.animationId);
            }
            if (this.resizeObserver) {
                this.resizeObserver.disconnect();
            }
        }
    },
    mounted() {
        this.initCarousel();
    },
    beforeUnmount() {
        this.cleanup();
    },
    watch: {
        reviews() {
            this.cleanup();
            this.pausedProgress = 0; // Сбрасываем прогресс при изменении отзывов
            this.$nextTick(() => {
                this.initCarousel();
            });
        }
    }
}

// Стили остаются без изменений
if (!window.__reviews_carousel_styles__) {
    const style = document.createElement('style');
    style.innerHTML = `
    .reviews-carousel-horizontal {
        position: relative;
        overflow: hidden;
    }

    .reviews-carousel-horizontal::before,
    .reviews-carousel-horizontal::after {
        content: '';
        position: absolute;
        top: 0;
        bottom: 0;
        width: 100px;
        pointer-events: none;
        z-index: 2;
    }

    .reviews-carousel-horizontal::before {
        left: 0;
        background: linear-gradient(90deg, #2a1931 0%, transparent 100%);
    }

    .reviews-carousel-horizontal::after {
        right: 0;
        background: linear-gradient(270deg, #2a1931 0%, transparent 100%);
    }

    .reviews-carousel-horizontal .carousel-track {
        display: flex;
        width: max-content;
        will-change: transform;
    }

    .review-card-horizontal {
        flex: 0 0 300px;
        margin: 0 12px;
        background: #2a1931;
        border: 1px solid #513060;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        padding: 18px 20px;
        min-height: 120px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        transition: box-shadow 0.2s ease;
    }

    .review-card-horizontal:hover {
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.2);
    }

    .review-author {
        font-weight: bold;
        margin-bottom: 8px;
    }

    .review-text {
        flex: 1;
    }

    .review-date {
        color: #6c757d;
        font-size: 0.875rem;
        margin-top: 8px;
    }

    /* Адаптивность для мобильных устройств */
    @media (max-width: 768px) {
        .review-card-horizontal {
            flex: 0 0 280px;
            margin: 0 8px;
            padding: 16px;
            min-height: 100px;
        }

        .reviews-carousel-horizontal::before,
        .reviews-carousel-horizontal::after {
            width: 60px;
        }
    }

    @media (max-width: 480px) {
        .review-card-horizontal {
            flex: 0 0 260px;
            margin: 0 6px;
            padding: 12px;
            min-height: 90px;
        }

        .reviews-carousel-horizontal::before,
        .reviews-carousel-horizontal::after {
            width: 40px;
        }
    }
    `;
    document.head.appendChild(style);
    window.__reviews_carousel_styles__ = true;
}
