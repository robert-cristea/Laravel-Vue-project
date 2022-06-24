<template>
    <div class="w-100">
        <main-section-header
                :criteria-title="criteriaTitle"
                :sub-criteria-title="subCriteriaTitle"
                :super-sub-criteria-title="superSubCriteriaTitle"
                :instructions="instructions"
                :print-scope-one="printScopeOne"
                :print-scope-two="printScopeTwo"
                :print-scope-three="printScopeThree"
        >
        </main-section-header>

        <staff-commuting
                :table-id="tableId"
                :template-data-model="firstTemplateModel"
                id="113a"
                key="113a"
                :first-column-name="firstTypeName"
                :second-column-name="firstMeasureName"
                v-model="grandTotalA"
                class="w-100"
        ></staff-commuting>

        <staff-commuting
                :table-id="tableId"
                :template-data-model="secondTemplateModel"
                id="113b"
                key="113b"
                :first-column-name="secondTypeName"
                :second-column-name="secondMeasureName"
                v-model="grandTotalB"
                class="w-100"
                :type="2"
        ></staff-commuting>
        <div class="row">
            <div class="col-12 w-100">
                <table class=".table form-group" style="width: 100%">
                    <tr style="background-color: YellowGreen; color: black;">
                        <td colspan=5>Grand Total</td>
                        <td align="right">{{ grandTotal.toFixed(4) }}</td>
                        <td align="right">t CO2e</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
  import CfcMixins from '../mixins/dataHandling.js'
  import dataHandlingMixins from '../mixins/dataHandling.js'
  import grandTotalSum from '../mixins/grandTotalSum'
  export default {
    mixins: [CfcMixins, dataHandlingMixins, grandTotalSum],
    props: {
      'tableId': {
        type: String
      },
      'firstTypeName': {
        type: String,
        default: 'Old Method'
      },
      'firstMeasureName': {
        type: String,
        default: 'kWh'
      },
      'secondTypeName': {
        type: String,
        default: 'New Method'
      },
      'secondMeasureName': {
        type: String,
        default: 'kWh'
      },
      'firstTemplateModel': {
        type: String,
        default: 'old_electric_consumption'
      },
      'secondTemplateModel': {
        type: String,
        default: 'new_electric_consumption'
      },
      'printHeader': {
        type: Boolean,
        default: false
      },
      'printScopeOne': {
        type: Boolean,
        default: false
      },
      'printScopeTwo': {
        type: Boolean,
        default: false
      },
      'printScopeThree': {
        type: Boolean,
        default: false
      }
    },
    data () {
      return {
        stageTitle: '',
        criteriaTitle: '',
        subCriteriaTitle: '',
        superSubCriteriaTitle: '',
        instructions: '',
        grandTotalA: 0,
        grandTotalB: 0,
        grandTotal: 0,
        rowData: []
      }
    },
    created () {
      this.template_data = template_data
      this.project_data = project_data
      this.updateTemplateData()
    }
  }
</script>
