<template>
    <div id="sources">
        <fieldset>
            <legend>Relevant Links</legend>
            <button v-on:click.prevent="increaseSources">Add Source</button>
            <div v-for="n in numSources">
                <input type="hidden" v-bind:name="'source[' + n + '][id]'" v-bind:value="itemSources[n-1]?itemSources[n-1]['id']:''">
                <div class="form-group">
                    <label for="sourceType" class="col-md-2 control-label">Source type</label>

                    <div class="col-md-8">
                        <select id="sourceType" type="text" class="form-control" v-bind:name="'source[' + n + '][sourceType]'">
                            <option value="link" v-bind:selected="getSourceType(itemSources[n-1]) == 'link'">Link</option>
                            <option value="book" v-bind:selected="getSourceType(itemSources[n-1]) == 'book'">Book</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="sourceDescription" class="col-md-2 control-label">
                        Detail
                    </label>

                    <div class="col-md-8">
                        <input id="sourceDescription" type="text" class="form-control" v-bind:name="'source[' + n + '][description]'" v-bind:value="itemSources[n-1]?itemSources[n-1]['description']:''" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="sourceLink" class="col-md-2 control-label">Link</label>

                    <div class="col-md-8">
                        <input id="sourceLink" type="text" class="form-control" v-bind:name="'source[' + n + '][link]'" v-bind:value="itemSources[n-1]?itemSources[n-1]['link']:''" >
                    </div>
                </div>
            </div>
        </fieldset>
    </div>
</template>

<script>
    export default {
        name: "ItemSources",
        data() {
            return {
                numSources: this.itemSources.length
            }
        },
        props: {
            itemSources: {
                type: Array,
                default: function() { return [] }
            },
            defaultType: {
                type: String,
                default: 'link'
            }
        },
        methods: {
            increaseSources: function (event) {
                this.numSources += 1;
            },
            getSourceType: function( source ) {
                if ( source ) {
                    console.log( source['sourceType'] );
                    return source['sourceType'];
                }
                else {
                    return this.defaultType;
                }
            }
        }
    }
</script>

<style scoped>

</style>