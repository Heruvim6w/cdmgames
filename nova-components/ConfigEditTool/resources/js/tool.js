Nova.booting((Vue, router, store) => {
  router.addRoutes([
    {
      name: 'config-edit-tool',
      path: '/config-edit-tool',
      component: require('./components/Tool'),
    },
  ])
})
