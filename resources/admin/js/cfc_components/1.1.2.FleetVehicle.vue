<template>
    <div class="w-100">
        <main-section-header
                :criteria-title="criteriaTitle"
                :subCriteriaTitle="subCriteriaTitle"
                :super-sub-criteria-title="superSubCriteriaTitle"
                :instructions="instructions"
                :print-scope-one="printScopeOne"
                :print-scope-two="printScopeTwo"
                :print-scope-three="printScopeThree"
        >
        </main-section-header>

        <div>
            <h5>Method (A): Fuel Based Method</h5>
        </div>
        <fleet-vehicle-a
                :table-id="tableId"
                :template-data-model="templateDataModel"
                id="fleet-a"
                key="fleet-a"
                v-model="grandTotalA"
                class="w-100"
        ></fleet-vehicle-a>
        <div>
            <h5>Method (B): Distance Based Method</h5>
        </div>
        <staff-commuting
                :table-id="tableId"
                :template-data-model="templateDataModel"
                id="fleet"
                key="fleet"
                v-model="grandTotalB"
                class="w-100"
                :type="2"
        ></staff-commuting>
        <div class="row">
            <div class="col-12 w-100">
                <table class=".table form-group" style="width: 100%">
                    <tr style="background-color: YellowGreen; color: black;">
                        <td colspan=5>Grand Total</td>
                        <td align="right"><input type="text" :value="grandTotal.toFixed(4)"></td>
                        <td align="right">t CO2e</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
  import dataHandlingMixins from '../mixins/dataHandling.js'
  import grandTotalSum from '../mixins/grandTotalSum'
  export default {
    mixins: [dataHandlingMixins, grandTotalSum],
    props: {
      'templateDataModel': {
        type: String,
        default: 'fleet_vehicle'
      },
      'tableId': {
        type: String,
        default: '1.1.2'
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
      this.updateTemplateData()
    }
  }
</script>
