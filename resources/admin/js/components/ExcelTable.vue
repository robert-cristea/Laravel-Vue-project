<template>
    <div>
        <h2>{{ criteria_title }}</h2>
        <h2>{{ sub_criteria_title }}</h2>
        <h3>{{ super_sub_criteria_title }}</h3>

        <div style="background-color: cyan;">
            {{ instructions }}
        </div>

        <div class="row">
            <div class="col-12">
                <table class=".table" style="table-layout: fixed;">
                    <tr style="background-color: YellowGreen; color: black;">
                        <td></td>
                        <td style="max-width: 100px;">No.</td>
                        <td>Type of vehicle</td>
                        <td>Distance (km)</td>
                        <td>Emission Factor</td>
                        <td>Carbon Emission</td>
                    </tr>
                    <tr v-for="(item, index) in rowData" :key="index">
                        <td v-on:click="removeItem(item)" v-model="item.id">
                            <i class="icon-fa icon-fa-trash"/>
                        </td>
                        <td class="col-1">
                            {{ item.id }}
                        </td>
                        <td class="col-3">
                            <select v-on:change="onSelect($event)" value="" :id="index" v-model="rowData[index].option">
                                <option v-for="optionItem in optionItems" :value="optionItem.id" :key="optionItem.id">
                                    {{ optionItem.title }}
                                </option>
                            </select>
                        </td>
                        <td class="col-2">
                            <input type="text"
                                   :id="index"
                                   v-model="rowData[index].distance"
                                   v-on:change="updateDistanceValue">
                        </td>
                        <td class="col-2">{{ item.emission_factor }}</td>
                        <td class="col-2">{{ item.carbon_emission }}</td>
                    </tr>
                    <tr>
                        <td colspan=5>
                            <button v-on:click="addItem">Add new row</button>
                        </td>
                    </tr>
                    <tr>
                        <th colspan=3>Total</th>
                        <th>{{ total_distance }}</th>
                        <th></th>
                        <th>{{ total_carbon_emission }}</th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
  export default {
    props: ['table_id'],
    data () {
      return {
        template_data_model: 'staff_commuting',
        selected: '',
        stage_title: '',
        criteria_title: '',
        sub_criteria_title: '',
        super_sub_criteria_title: '',
        instructions: '',
        total_distance: 0,
        total_carbon_emission: 0,
        id: 0,
        optionItems: [],
        columns: [],
        rowData: []
      }
    },
    methods: {
      onSelect (event) {
        var index = event.target.id
        var value = this.rowData[index]['option']
        this.rowData[index].emission_factor = template_data['data'][this.template_data_model][value].distance
      },
      addItem () {
        this.id++
        var newRow = {
          id: this.id,
          option: null,
          distance: 0,
          emission_factor: 0,
          carbon_emission: 0
        }
        this.rowData.push(newRow)
      },
      removeItem (item) {
        for (var i = 0; i < this.rowData.length; i++) {
          if (this.rowData[i].id == item.id) {
            this.rowData.splice(i, 1)
            break
          }
        }
      },
      updateDistanceValue () {
        this.total_distance = 0
        for (var i = 0; i < this.rowData.length; i++) {
          var temp_distance = parseInt(this.rowData[i].distance);
          if (temp_distance !== 'undefined' && Number.isInteger(temp_distance)) {
            this.total_distance += temp_distance
          }
        }
        this.updateCarbonEmission()
      },
      updateTemplateData () {
        var stages = template_data['stages']
        this.stage_title = stages[1]['title']
        this.criteria_title = stages[1]['stages'][1]['title']
        this.sub_criteria_title = stages[1]['stages'][1]['stages'][1]['title']

        // testing this is case 1.1.1
        this.optionItems = template_data['data'][this.template_data_model]
      },
      updateCarbonEmission () {
        this.total_carbon_emission = 0
        for (var i = 0; i < this.rowData.length; i++) {
          var emission_factor = this.rowData[i]['emission_factor']
          var distance = this.rowData[i]['distance']
          if (emission_factor !== 0 && distance !== 0) {
            var carbon_emission = distance * emission_factor
            this.rowData[i].carbon_emission = carbon_emission
            this.total_carbon_emission += carbon_emission
          }
        }
      }
    },
    watch: {
      project_data: function () {
        this.items = []
      },
      template_data: function () {
        this.updateTemplateData()
      }
    },
    created () {
      this.updateTemplateData()
    }
  }
</script>
