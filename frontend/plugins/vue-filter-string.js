import Vue from 'vue'

Vue.filter('capitalize', function (value) {
      if (!value) return ''
      value = value.toString()
  return value.charAt(0).toUpperCase() + value.slice(1)
})

Vue.filter('upper', function (value) {
        if (!value) return ''
        value = value.toString()
	return value.toUpperCase()
})

Vue.filter('lower', function (value) {
        if (!value) return ''
        value = value.toString()
	return value.toLowerCase()
})

Vue.filter('ucFirst', function (string) {

    return string.charAt(0).toUpperCase() + string.slice(1);
})

Vue.filter('ucWords', function (str) {

    return str.replace(/(^([a-zA-Z\p{M}]))|([ -][a-zA-Z\p{M}])/g,
        function($1){
            return $1.toUpperCase();
        });
})

