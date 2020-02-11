<template>
    
        
        <Table border :columns="columns" :data="tabledata" >
            <template slot-scope="{ row }" slot="name">
                <strong>{{ row.name }}</strong>
            </template>
            <template slot-scope="{ row }" slot="download">
                <Button type="primary" size="small"  @click="download(row)">View</Button>
                
            </template>
        </Table>
        
        
    
    
</template>

<script>
    export default {
        name: '',
        
        data() {
            return {
                mid:'1',
                loading :true,
                columns: [
                    {
                        title:'上传号',
                        key:'id'
                    }
                    ,
                    {
                        title:'宿舍号',
                        key:'dormname'
                    },
                    {
                        title:'已交',
                        key :'upif'
                    },
        
                    {
                        title: '下载',
                        slot : 'download',
                        width:150,
                        align:'center'
                    }
                ],
                tabledata: [
                    
                ]
            }
        },
        mounted: function(){
            let formdata = new FormData();
            formdata.append('missionid',this.mid);
            console.log(formdata);
            axios.post('/servant/uplist',formdata).then(res=>{
                if(this.tabledata==null)
                    {
                        this.loading=true;
                        console.log(res);
                    this.tabledata=res.data;
                    }
                else
                {
                    this.tableview=false;
                    this.tabledata=res.data;
                }
            }).catch(err=>{
                console.log(err);
            })
            
        },
        methods:{
            download:function(row){
                let formdata=new FormData();
                formdata.append('id',row.id);
                axios.post('/servant/download',formdata).then(res=>{
                    console.log(res);
                });
            }
        }
    }
</script>

<style lang="" scoped>
    
</style>