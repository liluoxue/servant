<template>
    
        <div>
        <Table border :columns="columns" :data="tabledata" >
            
            <template slot-scope="{ row }" slot="name">
                <strong>{{ row.name }}</strong>
            </template>
            <template slot-scope="{ row }" slot="download">
                <Button type="primary" size="small"  @click="download(row)">下载</Button>
                
            </template>
        </Table>
        <Modal
        v-model="modal1"
        title="该宿舍还没交作业噢"
        @on-ok="ok"
        @on-cancel="cancel">
        <p>催他们交作业咯~</p>
        </Modal>
        
        </div>
    
    
</template>

<script>
    export default {
        name: '',
        
        data() {
            return {
                mid:'1',
                missionname:'',
                modal1: false,
                loading :true,
                columns: [
                    
                    {
                        title:'宿舍号',
                        key:'dormname',
                        align:'center'
                    },
                    {
                        title:'已交',
                        key :'upif',
                        align:'center',
                        render:(h,params) =>{
                            const row =params.row;
                            const color =row.upif===1?'success' : row.upif===0?'error':'error';
                            const text =row.upif===1?'已交' : row.upif===0?'未交':'未交';
                            return h('Tag',{
                                props:{
                                    type:'dot',
                                    color:color
                                }
                            },text);
                            
                        }
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
            this.mid=this.$route.query.missionid;
            this.missionname=this.$route.query.missionname;
            console.log(this.mid);
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
                
                if(!this.tabledata[row._index].id)
                {
                    this.modal1=true;
                }
                formdata.append('id',this.tabledata[row._index].id);
                let config={                
                                 
                    responseType: 'blob',            
                }
                /*
                axios.post('/servant/download',formdata).then(response=>{
                    console.log(response);
                    const url = window.URL.createObjectURL(new Blob([response.data]));                
                    const link = document.createElement('a');                
                    link.href = url;                
                    link.setAttribute('download', 'file.cpp');                
                    document.body.appendChild(link);                
                    link.click();       
                });
                */
               axios.post('/servant/download',formdata).then(response=>{
                    console.log(response);
                    const url = response.data.url;               
                    const link = document.createElement('a');                
                    link.href = url;                
                    link.setAttribute('download', response.data.name);                
                    document.body.appendChild(link);                
                    link.click();       
                });
            }
        }
    }
</script>

