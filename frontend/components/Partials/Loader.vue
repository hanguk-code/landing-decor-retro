<template>
    <div class="preloader" v-show="statusElem">
        <div class="preloader__status">
            <div ref="statusElem" class="preloader__status-text">I'm {{ loaded }} % done!</div>
            <div ref="loader" class="preloader__status-loader">
                <div :style="loadStyle" class="preloader__status-bar"></div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            loaded: 0,
            loading: null,
            loadStyle: {
                width: '0%'
            },
            statusElem: true,
            loader: '',
            body: ''
        }
    },
    beforeMount() {
        this.loader = this.$refs.loader
        this.body = document.body

        this.preloader = this.$el;
        this.removeScrolling();
        this.startLoading();
    },
    watch: {
        loaded() {
            this.loadStyle.width = this.loaded;
        }
    },
    methods: {
        removeScrolling() {
            this.body.style.setProperty('overflow', 'hidden');
        },
        startLoading() {
            this.loading = setInterval(this.load, 1);
        },
        load() {
            this.loaded < 100 ? this.loaded++ : this.doneLoading();
        },
        doneLoading() {
            clearInterval(this.loading);
            this.updateStatus();
        },
        updateStatus() {
            // this.statusElem.text('Lets get crazay !');
            // this.loader.style.setProperty('display', 'none');
            this.removePreloader();
        },
        animatePreloader() {
            let app = this,
                // height = this.preloader.style.getProperty('height'),
                properties = {
                    'margin-top': 0
                },
                options = {
                    duration: 100,
                    easing: 'swing',
                    complete() {
                        app.removePreloader()
                    }
                };
            // this.preloader.delay(500).animate(properties, options)
        },
        removePreloader() {
            // this.preloader.remove();
            this.statusElem = false
            // this.body.removeAttr('style');
            this.body.style.setProperty('overflow', 'auto');
            this.animateWebsite();
        },
        animateWebsite() {
            console.log('lets get pretty');
        }
    }
}

</script>
<style scoped>
@import "https://fonts.googleapis.com/css?family=Raleway";

.preloader {
    width: 100%;
    height: 100vh;
    background: #3498db;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    color: white;
    font-family: "Raleway", sans-serif;
    position: absolute;
    z-index: 999;
    top: 264px;
}

.preloader__status {
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
}

.preloader__status-text {
    font-size: 40px;
    font-family: "Raleway", sans-serif;
    margin-bottom: 20px;
}

.preloader__status-loader {
    width: 100%;
    height: 3px;
}

.preloader__status-bar {
    background: white;
    height: 100%;
}

.frontpage {
    height: 100vh;
    background: #34495e;
}

.frontpage__title {
    color: white;
}

</style>
