<template>
    <div class="col-12">
        <construction-header-form
                :table-id="tableId"
                v-model="productivity"
        ></construction-header-form>
    </div>
</template>

<script>
  import dataHandlingMixins from '../mixins/dataHandling.js'
  export default {
    mixins: [dataHandlingMixins],
    props: {
      'templateDataModel': {
        type: String,
        default: 'machinery_work_patching'
      },
      'tableId': {
        type: String,
        default: ''
      },
      'printHeader': {
        type: Boolean,
        default: false
      },
      'firstColumnName': {
        type: String,
        default: 'Machineries'
      },
      'secondColumnName': {
        type: String,
        default: 'Nos.'
      },
      'thirdColumnName': {
        type: String,
        default: 'Fuel Usage'
      },
      'id': {
        type: String,
        default: ''
      },
      'productivityUnit': {
        type: String,
        default: 'm3'
      },
      'withExistingHighwayPercent': {
        type: Boolean,
        default: false
      }
    },
    data: function() {
      return {
        stageTitle: '',
        criteriaTitle: '',
        subCriteriaTitle: '',
        superSubCriteriaTitle: '',
        instructions: '',
        scope_1_machinery: 0,
        scope_1_sc: 0,
        scope_2_elec: 0,
        scope_3_water: 0,
        scope_3_paper: 0,
        scope_3_material: 0,
        scope_3_transportation: 0,
        emission: 0,
        productivity: 0,
        currentIdCounter: 0,
        optionItems: [],
        rowData: []
      }
    },
    methods: {
      onSelect (event) {
        var index = event.target.id
        var value = this.rowData[index]['option']
        this.rowData[index].emission_factor = template_data['data'][this.$props.templateDataModel][value].distance
        this.updateCarbonEmission()
      },
      updateCarbonEmission () {
        this.subTotalCarbonEmission = 0
        var total = 0
        for (var i = 0; i < this.rowData.length; i++) {
          total += this.getRowCarbonEmission(i)
        }
        this.subTotalCarbonEmission = total
      },
      getRowCarbonEmission(i) {
        //first get emission_factor, that is distance in this case
        var rowData = this.rowData[i]
        var emissionFactor = 0
        var distance = rowData.distance
        var secondValue = rowData.secondValue
        var truckConstant = 0.35 // value in 5 MC 4.2.2, Keywords.D24
        var machineryEmissionFactor = 0.00268 // value in 5 MC 4.2.2, Keywords.C17
        //second get carbon_emission for this row
        if (distance !== 0 && secondValue != 0) {
          emissionFactor = (distance * secondValue) / truckConstant
          rowData.emission_factor = emissionFactor
          rowData.carbon_emission = emissionFactor * machineryEmissionFactor
          this.$set(this.rowData, i, rowData)
        }
        return rowData.carbon_emission
      },
      emitTotal(total) {
        var total_object = {
          scope_1_machinery: this.scope_1_machinery,
          scope_1_sc: this.scope_1_sc,
          scope_2_elec: this.scope_2_elec,
          scope_3_water: this.scope_3_water,
          scope_3_paper: this.scope_3_paper,
          scope_3_material: this.scope_3_material,
          scope_3_transportation: this.totalB,
          emission: total,
          unit: this.$props.productivityUnit,
        }
        this.$emit('input', total_object)
      }
    },
    created () {
      this.optionItems = template_data['data'][this.$props.templateDataModel]
      this.warmData();
      this.updateTemplateData()
    },
    computed: {
      grandTotal() {
        var total = this.scope_1_machinery + this.scope_1_sc + this.scope_2_elec + this.scope_3_water
          + this.scope_3_paper + this.scope_3_material + this.scope_3_transportation
        this.emitTotal(total)
        return total
      }
    }
  }
</script>
