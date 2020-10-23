Nova.booting((Vue, router, store) => {
  Vue.component('index-nova-emoji-field-container', require('./components/IndexField').default)
  Vue.component('detail-nova-emoji-field-container', require('./components/DetailField').default)
  Vue.component('form-nova-emoji-field-container', require('./components/FormField').default)
})
