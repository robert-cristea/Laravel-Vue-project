<template>
    <div>
        <main-section-header
                :criteria-title="criteriaTitle"
                :subCriteriaTitle="subCriteriaTitle"
                :super-sub-criteria-title="superSubCriteriaTitle"
                :instructions="instructions"
        >
        </main-section-header>

        <div class="row">
            <div class="col-12">
                <construction-header-form
                        :table-id="tableId"
                        v-model="productivity"
                        :productivity-unit="productivityUnit"
                ></construction-header-form>
            </div>
            <div class="col-12">
                <remove-surcharge-standard-form
                        :table-id="tableId"
                        :productivity="productivity"
                        class="w-100"
                        v-model="scope_1_machinery"
                        :total-unit="totalUnit"
                >
                </remove-surcharge-standard-form>
            </div>
            <div class="col-12">
                <remove-surcharge-standard-form
                        :table-id="tableId"
                        header-title="Scope 3 (Indirect: Embodies Carbon)"
                        header-color="background-color: #4fc47f; color: white"
                        total-label="Emission per activity for Scope 3 (transportation):"
                        template-data-model="transportation_of_material"
                        first-column-name="Transportation of Material"
                        :productivity="productivity"
                        class="w-100"
                        v-model="scope_3_transportation"
                        :total-unit="totalUnit"
                        type="2"
                >
                </remove-surcharge-standard-form>
            </div>
            <div class="col-12">
                <div class="w-100">
                    <table>
                        <tr>
                            <td colspan="3">All Scopes</td>
                        </tr>
                        <tr>
                            <td>Emission per activity for all Scope:</td>
                            <td><input type="text" :value="grandTotal" disabled class="form-control"></td>
                            <td>{{ totalUnit }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="col-12">
                <previous-next-button></previous-next-button>
            </div>
            <!--<div class="col-12 card construction-database">
                <construction-database
                        :table-id="tableId"
                        header-title="LLM database:"
                        header-color="background-color: white"
                        class="w-100"
                >
                </construction-database>
            </div>-->
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
      'totalUnit': {
        type: String,
        default: 't CO2e/m3'
      }
    },
    data: function() {
      return {
        stageTitle: '',
        criteriaTitle: '',
        subCriteriaTitle: '',
        superSubCriteriaTitle: '',
        instructions: '',
        // header
        concessionaires: '',
        section: '',
        person_in_charge: '',
        date_start: null,
        date_end: null,
        productivity_days: 0,
        // totals
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
        grandTotal: 0,
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
          scope_3_transportation: this.scope_3_transportation,
          emission: total,
          unit: this.$props.productivityUnit,
        }
        this.$emit('input', total_object)
      },
      updateTotal() {
        var total = this.scope_1_machinery + this.scope_1_sc + this.scope_2_elec + this.scope_3_water
          + this.scope_3_paper + this.scope_3_material + this.scope_3_transportation
        this.emitTotal(total)
        this.grandTotal = total
        return total
      }
    },
    created () {
      this.optionItems = template_data['data'][this.$props.templateDataModel]
      this.warmData();
      this.updateTemplateData()
    },
    watch: {
      scope_1_machinery() {
        this.updateTotal()
      },
      scope_1_sc() {
        this.updateTotal()
      },
      scope_2_elec() {
        this.updateTotal()
      },
      scope_3_water() {
        this.updateTotal()
      },
      scope_3_paper() {
        this.updateTotal()
      },
      scope_3_material() {
        this.updateTotal()
      },
      scope_3_transportation() {
        this.updateTotal()
      }
    }
  }
</script>
