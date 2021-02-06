function isThereSlashEnd(path) {
    let isSlash = true
    if (path) {
        let length = path.length
        isSlash = path[length-1] == '/' ? true : false
        console.log('??? path222: ', path, path[length-1], isSlash)
    }
    return isSlash
}
export default function({ req, store, route, redirect }) {
    let routeEx = ['products', 'pages'];
    if( routeEx.indexOf(route.name) === -1) {
        /**
         * Add slash of '/' at the end of url
         */
        let isSlash = isThereSlashEnd(route.fullPath)
        console.log('??? path111: ', isSlash, route.fullPath, process.client)
        if (!isSlash) {
            if (process.client) {
                window.location.href = route.fullPath + '/'
                console.log('??? path: ', isSlash, route.fullPath, process.client, window.location)
            }
        }
    }
}
