<template>

    <Card>
        <p slot="title">管理员界面</p>
        <Button slot="extra" @click="alertMissionModal" type="primary" size="small">创建任务</Button>
        <Table border :columns="columns" :data="tabledata">

            <template slot-scope="{ row }" slot="name">
                <strong>{{ row.name }}</strong>
            </template>
            <template slot-scope="{ row }" slot="goto">
                <Button type="primary" size="small" @click="goto(row)">进入</Button>

            </template>
        </Table>
        <Modal v-model="mmodal" title="该宿舍还没交作业噢" >
            <p>催他们交作业咯~</p>
        </Modal>
        <Modal v-model="missionModal" title="注册" :footer-hide=true>
      <div style="text-align:center">
        <Form ref="formline" :model="formline" rules="ruleInline">
          <FormItem label="任务名" prop="mname">
            <Input type="text" v-model="mission.mname" placeholder="任务名"></Input>
          </FormItem>
         
          <FormItem>
            <Button type="primary" @click="createMission">新建</Button>
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
        name: '',

        data() {
            return {
                mid: '1',
                mmodal: false,
                loading: true,
                missionModal: false,
                did: '',
                dname: '',
                columns: [

                    {
                        title: '任务号',
                        key: 'id',
                        align:'center'
                    },
                    {
                        title: '该交的任务',
                        key: 'fname',
                        align:'center'
                    },

                    {
                        title: '进入',
                        slot: 'goto',
                        width: 150,
                        align: 'center'
                    }
                ],
                mission:{
                    mname:'',
                    status:'',
                    time:'',
                },
                tabledata: [

                ]
            }
        },
        mounted: function () {
            this.getMissionList();

        },
        methods: {
            goto: function (row) {
                console.log(row.id);
                this.$router.push({
                    name: 'admin',
                    query: {
                        missionid : row.id,
                        dormid: this.did,
                        missionname:row.fname
                    }
                })
            },
            alertMissionModal:function(){
                this.missionModal=true;
            },
            createMission:function(){
                let formdata=new FormData();
                formdata.append("mname",this.mission.mname);
                axios.post('/missions',formdata).then(res=>{
                    this.$Message.success("添加成功~");
                    this.missionModal=false;
                    this.getMissionList();
                });
                
            },
            getMissionList: function () {
            let formdata = new FormData();
            formdata.append('mission', 'mission');

            this.did = this.$route.params.did;
            formdata.append('did', '-1');
            //console.log(formdata);
            axios.post('/missionlist', formdata).then(res => {
                //console.log(res);
                if (this.tabledata == null) {
                    this.loading = true;
                    console.log(res);
                    this.dname = res.data.dormname;
                    this.tabledata = res.data.missionlist;
                } else {
                    this.dname = res.data.dormname;
                    this.tabledata = res.data.missionlist;
                }
            }).catch(err => {
                console.log(err);
            })

        }
        }

    }
</script>