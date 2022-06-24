<template>
    <div>
        <div class="row" v-if="this.role=='superadmin' || this.role=='admin'">
            <h5>Assessors</h5>
            <div class="col-12">
                <table class="table table-sm form-group w-100">
                    <tr>
                        <th></th>
                        <th></th>
                        <th>Names</th>
                        <th>Approver</th>
                    </tr>
                    <tr v-for="(item, index) in rowData" :key="index">
                        <td v-on:click="removeItem(index)" v-model="item.id">
                            <i class="icon-fa icon-fa-trash"/>
                        </td>
                        <td>
                            {{ item.public_id }}
                        </td>
                        <td>
                            <select v-on:change="onSelect($event)"
                                    :name="`evaluators[${index}][id]`"
                                    value=""
                                    :id="index"
                                    :key="`${index}select`"
                                    v-model="item.evaluator_id" class="form-control">
                                <option v-for="optionItem in optionItems" :value="optionItem.id"   :key="optionItem.id">
                                    {{ optionItem.name }}
                                </option>
                            </select>
                        </td>
                        <td>
                            <input  v-on:change="onCheckboxChange($event)"
                                    type="checkbox"
                                    :name="`evaluators[${index}][approver]`"
                                    :id="index"
                                    :key="`${index}approver`"
                                    v-model="rowData[index].approver"
                                    class="form-control"></input>
                        </td>
                    </tr>
                    <tr>
                        <td colspan=6>
                            <button type="button" v-on:click="addItem" class="btn btn-secondary">Add new row</button>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="row mb-3" v-if="this.statusVal!=9">
            <div class="col-md-12" v-if="(this.role=='concessionaire' || this.role=='superadmin' || this.role=='admin') && this.statusVal==0">
                <button type="submit" name="applyAssessment" class="btn btn-success ml-2" >Apply Assessment</button>
            </div>
            <!--  @click="assessmentStatus('Apply Assessment')"-->
            <div class="col-md-12" v-if="(this.role=='superadmin'||this.role=='admin') && this.statusVal==1">
                <button  type="button" class="btn btn-success ml-2" @click="assessmentStatus('Approve Assessment')">Approve Assessment</button>
                <button  type="button" class="btn btn-danger" @click="assessmentStatus('Reject Assessment')">Reject Assessment</button>
            </div>

            <input  v-if="(this.role=='concessionaire' || this.role=='superadmin'||this.role=='admin')  && this.statusVal!=0 && this.statusVal!=1" type="submit" class="btn btn-primary " value="Save">
            <button v-if="(this.role=='concessionaire') && this.statusVal==2" type="button" class="btn btn-success ml-3" @click="assessmentStatus('Submit Assessment')">Submit Assessment</button>
            <!--<button v-if="(this.role=='concessionaire') && this.statusVal==2" type="submit" name="saveAsDraft" class="btn btn-warning ml-3">Save As Draft</button>-->
            <button  v-if="(this.role=='concessionaire') && this.statusVal==2" type="button" class="btn btn-primary ml-3" onclick="$('#guideline_navigation_tab').trigger('click')">Start Calculation</button>
            <button  v-if="(this.role=='auditor') && this.statusVal==3 && this.is_approver" type="button" class="btn btn-success ml-2" @click="assessmentStatus('Complete')">Submit Score</button>
            <!--<button  v-if="(this.role=='auditor') && this.statusVal==3" type="submit" class="btn btn-warning ml-2" name="saveAsDraftScore">Save As Draft Score</button>-->
            <!--  @click="assessmentStatus('Save As Draft Assessment')"-->
        </div>

    </div>
</template>

<script>
  import dataHandlingMixins from '../mixins/dataHandling.js'
  export default {
    mixins: [dataHandlingMixins],
    props: {
        'templateDataModel': {
            type: String,
            default: 'evaluators'
        },
        'auditorRoute':{
            type: String,
            required:true,
        },
        'role':{
          type:String,
            required: true
        },
        'tableId': {
            type: String,
            default: ''
        },
        'statusVal':{
          required:true,
        },
        'projectId': {
            type: String,
            required: true
        },
        'route':{
            type:String,
            required:true,
        }
    },
    data: function() {
        return {
            currentIdCounter: 0,
            optionItems: [],
            rowData: [],
            is_approver: project_data['evaluators'].find(item => item.evaluator_id == authUser.id && item.approver == 1) ? true : false,
        }
    },
    methods: {
        onSelect (event) {
            var index = event.target.id
            this.rowData[index].option = event.target.value
        },
        onCheckboxChange(event) {
            var index = event.target.id;
            this.rowData[index].approver = event.target.value
        },
        assessmentStatus(val) {
            this.assessmentColumns = {'assessment_status':val,'project_id':this.projectId};
            axios.post(this.route, this.assessmentColumns).then(data=> {
                console.log(data.data.result);
                window.location=data.data.result;
            }).catch(error=> {
                console.log(error);
            });
        },
        addItem () {
            this.currentIdCounter++
            var newRow = {
                id: this.currentIdCounter,
                title: null,
                approver: false,
                option: 0,
                public_id: this.currentIdCounter
            }
            this.rowData.push(newRow)
        },
        removeItem (index) {
            this.rowData.splice(index, 1);
        },
        warmData() {
            var evaluators = project_data['evaluators']
            for(var i=0; i < evaluators.length; i++) {
                this.currentIdCounter += 1
                this.rowData.push({
                    id: evaluators[i].id,
                    approver: evaluators[i].approver,
                    option: evaluators[i].id,
                    evaluator_id:evaluators[i].evaluator_id,
                    public_id: this.currentIdCounter
                });
            }
        }
    },
    created () {
        axios.get(this.auditorRoute).then(response => {
            this.optionItems = response.data
        }).catch(error => {
            console.log(error);
        });

        this.optionItems = template_data['data'][this.$props.templateDataModel]
        this.warmData()
    }
  }
</script>
