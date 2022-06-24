<template>
    <div style="overflow: auto">
        <table class="table table-sm form-group w-100">
            <tr>
                <th colspan="11" :style="headerColor">{{ headerTitle }}</th>
            </tr>
            <tr>
                <th></th>
                <th>No.</th>
                <th>Concessionaires</th>
                <th>Contractor/person in charge/date of assessment</th>
                <th>Productivity</th>
                <th>unit</th>
                <th colspan="3" align="center">Machineries & Equipment</th>
                <th colspan="2" align="center">Material Used</th>
                <th colspan="3" align="center">Transportation of Material</th>
                <th>Scope 1</th>
                <th>Scope 3</th>
                <th>All Scope</th>
            </tr>
            <tr v-for="(item, index) in rowData" :key="index">
                <td v-on:click="removeItem(index)" v-model="item.id">
                    <i class="icon-fa icon-fa-trash"/>
                </td>
                <td>
                    {{ item.id }}
                </td>
                <td valign="middle">
                    <input type="text" v-model="rowData[index].concessionaires" v-on:change="onChange()">
                </td>
                <td>
                    <input type="text" v-model="rowData[index].contractor" v-on:change="onChange()"><br>
                    <input type="text" v-model="rowData[index].person_in_charge" v-on:change="onChange()"><br>
                    <input type="text" v-model="rowData[index].date_of_assessment" v-on:change="onChange()">
                </td>
                <td>
                    <input type="text" v-model="rowData[index].productivity" v-on:change="onChange()">
                </td>
                <td>
                    <input type="text" v-model="rowData[index].unit" v-on:change="onChange()">
                </td>
                <td>
                    <input type="text" v-model="rowData[index].machines[0].title" v-on:change="onChange()">
                    <input type="text" v-model="rowData[index].machines[1].title" v-on:change="onChange()">
                    <input type="text" v-model="rowData[index].machines[2].title" v-on:change="onChange()">
                    <input type="text" v-model="rowData[index].machines[3].title" v-on:change="onChange()">
                    <input type="text" v-model="rowData[index].machines[4].title" v-on:change="onChange()">
                </td>
                <td>
                    <input type="text" v-model="rowData[index].machines[0].nos" v-on:change="onChange()">
                    <input type="text" v-model="rowData[index].machines[1].nos" v-on:change="onChange()">
                    <input type="text" v-model="rowData[index].machines[2].nos" v-on:change="onChange()">
                    <input type="text" v-model="rowData[index].machines[3].nos" v-on:change="onChange()">
                    <input type="text" v-model="rowData[index].machines[4].nos" v-on:change="onChange()">
                </td>
                <td>
                    <input type="text" v-model="rowData[index].machines[0].fuel_usage" v-on:change="onChange()">
                    <input type="text" v-model="rowData[index].machines[1].fuel_usage" v-on:change="onChange()">
                    <input type="text" v-model="rowData[index].machines[2].fuel_usage" v-on:change="onChange()">
                    <input type="text" v-model="rowData[index].machines[3].fuel_usage" v-on:change="onChange()">
                    <input type="text" v-model="rowData[index].machines[4].fuel_usage" v-on:change="onChange()">
                </td>

                <td>
                    <input type="text" v-model="rowData[index].material[0].title" v-on:change="onChange()">
                    <input type="text" v-model="rowData[index].material[1].title" v-on:change="onChange()">
                    <input type="text" v-model="rowData[index].material[2].title" v-on:change="onChange()">
                    <input type="text" v-model="rowData[index].material[3].title" v-on:change="onChange()">
                    <input type="text" v-model="rowData[index].material[4].title" v-on:change="onChange()">
                </td>
                <td>
                    <input type="text" v-model="rowData[index].material[0].material_used" v-on:change="onChange()">
                    <input type="text" v-model="rowData[index].material[1].material_used" v-on:change="onChange()">
                    <input type="text" v-model="rowData[index].material[2].material_used" v-on:change="onChange()">
                    <input type="text" v-model="rowData[index].material[3].material_used" v-on:change="onChange()">
                    <input type="text" v-model="rowData[index].material[4].material_used" v-on:change="onChange()">
                </td>

                <td>
                    <input type="text" v-model="rowData[index].transportation_of_material[0].title" v-on:change="onChange()">
                    <input type="text" v-model="rowData[index].transportation_of_material[1].title" v-on:change="onChange()">
                    <input type="text" v-model="rowData[index].transportation_of_material[2].title" v-on:change="onChange()">
                    <input type="text" v-model="rowData[index].transportation_of_material[3].title" v-on:change="onChange()">
                    <input type="text" v-model="rowData[index].transportation_of_material[4].title" v-on:change="onChange()">
                </td>
                <td>
                    <input type="text" v-model="rowData[index].transportation_of_material[0].nos" v-on:change="onChange()">
                    <input type="text" v-model="rowData[index].transportation_of_material[1].nos" v-on:change="onChange()">
                    <input type="text" v-model="rowData[index].transportation_of_material[2].nos" v-on:change="onChange()">
                    <input type="text" v-model="rowData[index].transportation_of_material[3].nos" v-on:change="onChange()">
                    <input type="text" v-model="rowData[index].transportation_of_material[4].nos" v-on:change="onChange()">
                </td>
                <td>
                    <input type="text" v-model="rowData[index].transportation_of_material[0].fuel_usage" v-on:change="onChange()">
                    <input type="text" v-model="rowData[index].transportation_of_material[1].fuel_usage" v-on:change="onChange()">
                    <input type="text" v-model="rowData[index].transportation_of_material[2].fuel_usage" v-on:change="onChange()">
                    <input type="text" v-model="rowData[index].transportation_of_material[3].fuel_usage" v-on:change="onChange()">
                    <input type="text" v-model="rowData[index].transportation_of_material[4].fuel_usage" v-on:change="onChange()">
                </td>
                <td>
                    <input type="text" v-model="rowData[index].scope_1" v-on:change="onChange()">
                </td>
                <td>
                    <input type="text" v-model="rowData[index].scope_3" v-on:change="onChange()">
                </td>
                <td>
                    <input type="text" v-model="rowData[index].all_scope" v-on:change="onChange()">
                </td>
            </tr>
            <tr>
                <td colspan=11>
                    <button v-on:click="addItem" class="btn btn-secondary">Add new row</button>
                </td>
            </tr>
        </table>
    </div>
</template>

<script>
  import dataHandlingMixins from '../mixins/dataHandling.js'
  export default {
    mixins: [dataHandlingMixins],
    props: {
      'templateDataModel': {
        type: String,
        default: 'emission_factor__vehicle'
      },
      'tableId': {
        type: String,
        default: ''
      },
      'printHeader': {
        type: Boolean,
        default: false
      },
      'id': {
        type: String,
        default: ''
      },
      'headerTitle': {
        type: String,
        default: 'Scope 1 (Direct: Combustion On-Site)'
      },
      'headerColor': {
        type: String,
        default: 'background-color: #ffa500'
      },
      'totalLabel': {
        type: String,
        default: 'Emission per activity for Scope 1:'
      },
      'productivity': {
        default: 0
      },
      'type': {
        default: 1
      },
      'totalUnit': {
        default: 'tCO2e/m3'
      }
    },
    data: function() {
      return {
        template_data: template_data,
        currentIdCounter: 0,
        optionItems: [],
        columns: [],
        rowData: []
      }
    },
    methods: {
      addItem () {
        this.currentIdCounter++
        var machines = []
        var material = []
        var transportation_of_material = []
        for(var i=0; i<5; i++) {
          machines[i] = {
            title: '',
            nos: 0,
            fuel_usage: 0
          }
          material[i] = {
            title: '',
            material_used: 0
          }
          transportation_of_material[i] = {
            title: '',
            nos: 0,
            fuel_usage: 0
          }
        }
        var newRow = {
          id: 0,
          concessionaires: '',
          contractor: '',
          person_in_charge: '',
          date_of_assessment: '',
          productivity: 0,
          unit: '',
          machines: machines,
          material: material,
          transportation_of_material: transportation_of_material,
          scope_1: 0,
          scope_3: 0,
          all_scope: 0
        }
        this.rowData.push(newRow)
      },
      removeItem (index) {
        this.rowData.splice(index, 1);
        this.storeDatabaseStructure();
      },
      storeDatabaseStructure() {
        var storageSection = 'construction_footer'
        var pathIds = this.getPathIds();
        var a = pathIds.length >= 1 ? pathIds[0] : null;
        var b = pathIds.length >= 2 ? pathIds[1] : null;
        var c = pathIds.length >= 3 ? pathIds[2] : null;
        var d = pathIds.length >= 4 ? pathIds[3] : null;
        for(var i=0; i < pathIds.lenght; i++) {
          pathIds[i] = Number.parseInt(pathIds[i]);
        }
        if(project_data[storageSection] === null) {
          project_data[storageSection] = []
        }
        if(pathIds.length === 4) {
          if(project_data[storageSection][a] == null) {
            project_data[storageSection][a] = []
          }
          if(project_data[storageSection][a][b] == null) {
            project_data[storageSection][a][b] = []
          }
          if(project_data[storageSection][a][b][c] == null) {
            project_data[storageSection][a][b][c] = []
          }
          project_data[storageSection][a][b][c][d] = this.rowData
        }
        else if(pathIds.length === 3) {
          if(project_data[storageSection][a] == null) {
            project_data[storageSection][a] = []
          }
          if(project_data[storageSection][a][b] == null) {
            project_data[storageSection][a][b] = []
          }
          if(project_data[storageSection][a][b][c] == null) {
            project_data[storageSection][a][b][c] = []
          }
          project_data[storageSection][a][b][c] = this.rowData
        }
        else if(pathIds.length === 2) {
          if(project_data[storageSection][a] == null) {
            project_data[storageSection][a] = []
          }
          if(project_data[storageSection][a][b] == null) {
            project_data[storageSection][a][b] = []
          }
          project_data[storageSection][a][b] = this.rowData
        }
        else if(pathIds.length === 1) {
          project_data[storageSection][a] = this.rowData
        }
      },
      onChange() {
        this.storeDatabaseStructure();
      },
      warmConstructionDatabase() {
        var pathIds = this.getPathIds();
        var a = pathIds.length >= 1 ? pathIds[0] : null;
        var b = pathIds.length >= 2 ? pathIds[1] : null;
        var c = pathIds.length >= 3 ? pathIds[2] : null;
        var d = pathIds.length >= 4 ? pathIds[3] : null;
        var settings = project_data['construction_footer'];
        if(settings === null) {
          return;
        }
        if(pathIds.length === 4 && settings[a] != null && settings[a][b] != null && settings[a][b][c] != null && settings[a][b][c][d] != null) {
          this.setDataInWarming(settings[a][b][c][d])
        }
        else if(pathIds.length === 3 && settings[a] != null && settings[a][b] != null && settings[a][b][c] != null) {
          this.setDataInWarming(settings[a][b][c])
        }
        else if(pathIds.length === 2 && settings[a] != null && settings[a][b] != null) {
          this.setDataInWarming(settings[a][b])
        }
        else if(pathIds.length === 1 && settings[a] != null) {
          this.setDataInWarming(settings[a])
        }
      },
    },
    created () {
      this.warmConstructionDatabase()
    }
  }
</script>
