<template>

    <Card>
        <p slot="title">{{dname}}</p>
        <Table border :columns="columns" :data="tabledata">

            <template slot-scope="{ row }" slot="name">
                <strong>{{ row.name }}</strong>
            </template>
            <template slot-scope="{ row }" slot="goto">
                <Button type="primary" size="small" @click="goto(row)">进入</Button>

            </template>
        </Table>
        <Modal v-model="modal1" title="该宿舍还没交作业噢" @on-ok="ok" @on-cancel="cancel">
            <p>催他们交作业咯~</p>
        </Modal>

    </Card>


</template>
<script>
    export default {
        name: '',

        data() {
            return {
                mid: '1',
                modal1: false,
                loading: true,
                did: '',
                dname: '',
                columns: [

                    {
                        title: '任务号',
                        key: 'id'
                    },
                    {
                        title: '该交的任务',
                        key: 'fname'
                    },

                    {
                        title: '进入',
                        slot: 'goto',
                        width: 150,
                        align: 'center'
                    }
                ],
                tabledata: [

                ]
            }
        },
        mounted: function () {
            let formdata = new FormData();
            formdata.append('mission', 'mission');

            this.did = this.$route.params.did;
            formdata.append('did', this.did);
            //console.log(formdata);
            axios.post('/servant/missionlist', formdata).then(res => {
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

        },
        methods: {
            goto: function (row) {
                console.log(row.id);
                this.$router.push({
                    name: 'up',
                    query: {
                        missionid : row.id,
                        dormid: this.did,
                        missionname:row.fname
                    }
                })
            }
        }

    }
</script>