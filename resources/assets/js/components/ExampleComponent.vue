<template>
    <div>

        <Row type="flex" justify="center" align="middle" class="code-row-bg">
            <Col span="8">
            <Card style="width:320px align:middle" class="ivu-card-align" v-model="did[0]">
                <div style="text-align:center" @click="mission1">
                    <img src="https://ae01.alicdn.com/kf/He72b1ab406f44cfea9039c32270004caN.png">
                    <h3>1</h3>
                </div>
            </Card>
            </Col>

            　　　　　　
            <Col span="8">
            <Card style="width:320px align:middle" class="ivu-card-align">
                <div style="text-align:center" @click="mission2">
                    <img src="https://ae01.alicdn.com/kf/He72b1ab406f44cfea9039c32270004caN.png">
                    <h3>2</h3>
                </div>
            </Card>
            </Col>

            　　　　　　
            <Col span="8">
            <Card style="width:320px align:middle" class="ivu-card-align">
                <div style="text-align:center" @click="mission3">
                    <img src="https://ae01.alicdn.com/kf/He72b1ab406f44cfea9039c32270004caN.png">
                    <h3>3</h3>
                </div>
            </Card>
            </Col>

            　　　　　　

            　　　　
        </Row>

    </div>
</template>

<script>
    export default {
        data() {
            return {
                did: [1, 2, 3]
            };
        },
        mounted() {
            console.log('Component mounted.')
            //console.log(this.did);
        },
        methods: {
            mission1: function () {
                this.$router.push('/mission/1');
            },
            mission2: function () {
                this.$router.push('/mission/2');
            },
            mission3: function () {
                this.$router.push('/mission/3');
            }
        }
    }
</script>