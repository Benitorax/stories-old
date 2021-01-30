<template>
    <div>
        <article class="message">
            <div class="message-body" :class="color">
                <span  style="margin-right:40px" class="is-hidden-mobile">
                    <i style="font-size: 25px;" :class="iconClass"></i>
                </span>
                <span class="is-size-4 bold">{{messageText}}</span>
            </div>
        </article>
    </div>
</template>

<script>
export default {
        props: ['message'],
        computed: {
            messageText() {
                return this.message.message;
            },
            color() {
                return this.message.colorClass;
            },
            iconClass() {
                return 'fas fa-'+this.message.iconClass;
            }
        }
}
</script>

<style>
    .message {
        margin-bottom: 5px !important;
    }
    .message-body {
        padding-bottom: 10px !important;
        padding-top: 10px !important;
    }

    .grey {
        background-color: lightgrey;
    }

    .green {
        background-color: lightgreen;
    }

    .yellow {
        background-color: lightyellow;
    }

    .orange {
        background-color: lightsalmon;
    }

    .red {
        background-color: lightcoral;
    }

    .violet {
        background-color: violet;
    }

    .blue {
        background-color: lightskyblue;
    }

    .dark-blue {
        background-color: blue;
        color: white;
    }

    .light-blue {
        background-color: #e2f5ff;
    }

    .white {
        background-color: white;
    }

    .black {
        background-color: black;
        color: white;
    }
    .bold {
        font-weight: 600;
    }
</style>