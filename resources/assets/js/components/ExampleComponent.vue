<template>
    <div>

        <Row type="flex" justify="center" align="middle" class="code-row-bg" :gutter="24">
            <Col span="8" v-for='dorm in dormList' >
            <Card style="width:320px;align:middle" class="ivu-card-align" v-model="did[0]">
                <div style="text-align:center" @click="dormMission(dorm)">
                    <img src="https://ae01.alicdn.com/kf/He72b1ab406f44cfea9039c32270004caN.png">
                    <h3>{{dorm.dormname}}</h3>
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
                did: [1, 2, 3],
                dormList:{}
            };
        },
        mounted() {
            console.log('Component mounted.')
            axios.post('/dormlist').then(res=>{
                this.dormList=res.data;
            })
            //console.log(this.did);
        },
        methods: {

            dormMission: function(dorm){
                //console.log(dorm);
                this.$router.push('/dorm/'+dorm.id);
            }
        }
    }
</script>