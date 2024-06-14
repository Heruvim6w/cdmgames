@include('layouts.header', ['title'=> 'Товары и цены'])
<style>
    body {
        background-color: var(--title-color) !important;
    }

    .price_table {
        margin-bottom: 10%;
    }

    th {
        background-color: #f6f6f6;
        color: #000;
    }

    .head-row {
        background-color: var(--theme-color);
        font-size: 18pt;
        color: #fff;
    }
</style>
<h1>Товары и цены</h1>

<section>
    <div class="container price_table">
        <table class="waffle" cellspacing="0" cellpadding="0">
            <thead>
                <th class="s0">ИНСТАНТ</th>
                <th class="s1">РП</th>
                <th class="s2 softmerge">стоимость, руб</th>
            </thead>
            <tbody>
                <tr style="height: 20px" class="head-row">
                    <td class="s3" colspan="3">Рекламное</td>
                </tr>
                <tr style="height: 20px">
                    <td class="s5">1 RP = {КУРС} + NO BAN + PRIME RP + CHECK DESCRIPTION + 2H DELIVERY TIME</td>
                    <td class="s6">1</td>
                    <td class="s6">0,4</td>
                </tr>
                <tr style="height: 20px" class="head-row">
                    <td class="s7" colspan="3">Скины</td>
                </tr>
                <tr style="height: 20px">
                    <td class="s5">NORMAL SKIN + INSTANT DELIVERY + NO BAN + 975 RP + PRIME RP + GIFT</td>
                    <td class="s6">975</td>
                    <td class="s6">390</td>
                </tr>
                <tr style="height: 20px">
                    <td class="s5">EPIC SKIN + INSTANT DELIVERY + NO BAN + 1350 RP + PRIME RP + GIFT</td>
                    <td class="s6">1350</td>
                    <td class="s6">540</td>
                </tr>
                <tr style="height: 20px">
                    <td class="s5">LEGENDARY SKIN + INSTANT DELIVERY + NO BAN + 1820 RP + PRIME RP + GIFT</td>
                    <td class="s8">1820</td>
                    <td class="s6">728</td>
                </tr>
                <tr style="height: 20px">
                    <td class="s5">ULTIMATE SKIN + INSTANT DELIVERY + NO BAN + 3250 RP + PRIME RP + GIFT</td>
                    <td class="s9">3250</td>
                    <td class="s6">1300</td>
                </tr>
                <tr style="height: 20px">
                    <td class="s5">CHROMA SKIN + INSTANT DELIVERY + NO BAN + 290 RP + PRIME RP + GIFT</td>
                    <td class="s8">290</td>
                    <td class="s6">116</td>
                </tr>
                <tr style="height: 20px" class="head-row">
                    <td class="s7" colspan="3">Ивентовое</td>
                </tr>
                <tr style="height: 20px">
                    <td class="s5">LOL HALL OF LEGENDS 2024 EVENT PASS + 1950 RP + INSTANT DELIVERY + NO BAN + PRIME RP</td>
                    <td class="s8">1950</td>
                    <td class="s6">780</td>
                </tr>
                <tr style="height: 20px">
                    <td class="s5">RISEN LEGEND COLLECTION + 5430 RP + INSTANT DELIVERY + PASS + AHRI SKIN + NO BAN + PRIME
                        RP
                    </td>
                    <td class="s6">5430</td>
                    <td class="s6">2172</td>
                </tr>
                <tr style="height: 20px">
                    <td class="s5">IMMORTALIZED LEGEND COLLECTION + 32430 RP + INSTANT DELIVERY + AHRI SKIN + NO BAN + PRIME
                        RP
                    </td>
                    <td class="s6">32430</td>
                    <td class="s6">12972</td>
                </tr>
                <tr style="height: 20px">
                    <td class="s5">SIGNATURE IMMORTALIZED LEGEND COLLECTION + 59260 RP + INSTANT DELIVERY + AHRI SKIN + PASS
                        100 LVL + NO BAN + PRIME RP
                    </td>
                    <td class="s6">59260</td>
                    <td class="s6">23704</td>
                </tr>
                <tr style="height: 20px" class="head-row">
                    <td class="s7" colspan="3">TFT</td>
                </tr>
                <tr style="height: 20px">
                    <td class="s5">TFT EVENT PASS + 1295 RP + INSTANT DELIVERY + NO BAN + PRIME RP</td>
                    <td class="s6">1295</td>
                    <td class="s6">518</td>
                </tr>
                <tr style="height: 20px">
                    <td class="s5">TFT CHIBI CHAMPION + 1900 RP + INSTANT DELIVERY + NO BAN + PRIME RP</td>
                    <td class="s6">1900</td>
                    <td class="s6">760</td>
                </tr>
                <tr style="height: 20px">
                    <td class="s5">TFT ARENA SKIN + 1380 RP + INSTANT DELIVERY + NO BAN + PRIME RP</td>
                    <td class="s6">1380</td>
                    <td class="s6">552</td>
                </tr>
                <tr style="height: 20px" class="head-row">
                    <td class="s7" colspan="3">Остальное</td>
                </tr>
                <tr style="height: 20px">
                    <td class="s5">TIMEWORN SKIN + 24H DELIVERY + NO BAN + 520 RP + PRIME RP + GIFT</td>
                    <td class="s6">520</td>
                    <td class="s6">208</td>
                </tr>
                <tr style="height: 20px">
                    <td class="s5">BUDGET SKIN + 24H DELIVERY + NO BAN + 750 RP + PRIME RP + GIFT</td>
                    <td class="s6">750</td>
                    <td class="s6">300</td>
                </tr>
            </tbody>
        </table>
    </div>
</section>
@include('layouts.footer')
</body>

</html>
