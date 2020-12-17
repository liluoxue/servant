<template>
    <Card>
        <p slot="title">dorm界面</p>
        <Button slot="extra" @click="modalshow" type="primary" size="small">创建dorm</Button>
    <Table :columns="columns" :data="data1"></Table>
    <Modal v-model="dormModal" title="注册" :footer-hide=true>
        <div style="text-align:center">
            <Form ref="formline" :model="dorm" rules="ruleInline">
                <FormItem label="任务名" prop="dormname">
                    <Input type="text" v-model="dorm.dormname" placeholder="dormname"></Input>
                </FormItem>

                <FormItem>
                    <Button type="primary" @click="createDorm">新建</Button>
                </FormItem>
                <div slot="footer">

                </div>
            </Form>
        </div>
    </Modal>
    </Card>
</template>

<script>
    export default {
        name: "admindorm",
        data(){
            return {
                columns: [
                    {
                        title: 'id',
                        key: 'id'
                    },
                    {
                        title: 'dormname',
                        key: 'dormname'
                    },
                ],
                data1 : [],
                dorm:{
                    dormname:''
                },
                dormModal:0,
            }
        },
        created() {
            this.getDorm();
        },
        methods:{
            getDorm:function(){
                axios.post('dormlist').then(res=>{
                    this.data1=res.data;
                    console.log(res.data);
                })
            },
            modalshow:function(){
              this.dormModal=1;
            },
            createDorm:function(){
                let formdata = new FormData();
                formdata.append('dormname',this.dorm.dormname);
                this.dormModal=0;
                axios.post('dorms',formdata).then(res=>{
                    this.$Message.success("create succuess~");
                    this.getDorm();
                }).catch(err=>{
                    console.log(err);
                })
            }
        }
    }

</script>

<style scoped>

</style>