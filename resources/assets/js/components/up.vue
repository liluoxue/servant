<template>
    <Card>
    <p slot="title">{{upWork.dormname}}</p>
    <Form ref="upWork" :model="upWork" :rules="ruleInline" :label-width="80">
        
             
        <!-- <FormItem prop="password" label="宿舍名">
            <Input type="text" v-model="upWork.dormname" placeholder="宿舍名">
            <Icon type="ios-lock-outline" slot="prepend"></Icon>
            </Input>
        </FormItem> -->
        <FormItem prop="password" label="文件名">
            <Input type="text" v-model="upWork.filename" placeholder="文件名">
            <Icon type="ios-lock-outline" slot="prepend"></Icon>
            </Input>
        </FormItem>
        <FormItem prop="password" label="任务号">
            <Input type="text" v-model="upWork.missionid" placeholder="任务号">
            <Icon type="ios-lock-outline" slot="prepend"></Icon>
            </Input>
        </FormItem>
        <FormItem>
            <Button type="primary" @click="handleSubmit('upWork')">上传</Button>
        </FormItem>
        <Upload multiple type="drag" :before-upload="handleUpload" action="//jsonplaceholder.typicode.com/posts/">
            <div style="padding: 20px 0">
                <Icon type="ios-cloud-upload" size="52" style="color: #3399ff"></Icon>
                <p>轻点人家传文件嘛~</p>
            </div>
        </Upload>
        <div v-if="file!==null"><p>{{file.name}}</p></div>
    </Form>
    </Card>
</template>
<script>
    export default {
        data() {
            return {
                upWork: {
                    dormid : '1',
                    dormname: '',
                    filename: '123',
                    missionid: '1'
                },
                ruleInline: {
                    dormname: [{
                        required: true,
                        message: '要填哦'
                    }],
                    filename: [{
                        required: true,
                        message: '要填哦'
                    }],
                    missionid: [{
                        required: true,
                        message: '要填哦'
                    }]
                },
                file: null,

            }
        },
        mounted:function(){
            let formdata = new FormData();
            //console.log(this.$route.params);
            console.log(this.$route.query);
            this.upWork.dormid=this.$route.query.dormid;
            this.upWork.missionid=this.$route.query.missionid;
            this.upWork.filename=this.$route.query.missionname;
            let config = {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }
            formdata.append('dormid',this.upWork.dormid);
            //console.log(formdata);
            axios.post('/dormname',formdata,config).then(res =>{
                this.upWork.dormname=res.data.dormname;
                console.log(res.data.dormname);
            }).catch(err=>{
                console.log(err);
            })
        },
        methods: {
            handleSubmit(upWork) {

                let formdata = new FormData();
                formdata.append('dormid', this.upWork.dormid);
                formdata.append('fname', this.upWork.filename);
                formdata.append('mid', this.upWork.missionid);
                formdata.append('file', this.file)



                /*        
                this.$http.post('/up',formdata).then(res=>{
                    this.$Message.success('Success!');
                },err =>{
                        this.$Message.error('Fail!');
                });
                */
                let config = {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }
                axios.post('/up', formdata,config).then(res => {
                    
                    console.log(res);
                    
                    this.$Message.success(res.data.msg);
                    // success callback
                }).catch(err => {
                    console.log(err);
                    this.$Message.error('上传失败');
                    // error callback
                });


            },
            handleUpload(file) {
                this.file = file;
                
                return false;
            }
        }
    }
</script>