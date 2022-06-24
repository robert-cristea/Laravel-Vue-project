<template>
    <div class="w-100">
        <main-section-header
                :criteria-title="criteriaTitle"
                :sub-criteria-title="subCriteriaTitle"
                :super-sub-criteria-title="superSubCriteriaTitle"
                :instructions="instructions"
        >
        </main-section-header>

        <div class="col-12">
            <remove-existing-surface v-model="grandTotalA"></remove-existing-surface>
        </div>

        <h5>Scope 3: Indirect Emissions</h5>
        <h5>Embodied Carbon</h5>

        <h6>In construction materials</h6>

        <staff-commuting
                :table-id="tableId"
                :template-data-model="firstTemplateModel"
                id="113a"
                key="113a"
                :first-column-name="firstTypeName"
                :second-column-name="firstMeasureName"
                v-model="grandTotalB"
                class="w-100"
        ></staff-commuting>

        <h6>Transport material</h6>

        <staff-commuting
                :table-id="tableId"
                :template-data-model="secondTemplateModel"
                id="113b"
                key="113b"
                :first-column-name="secondTypeName"
                :second-column-name="secondMeasureName"
                v-model="grandTotalC"
                class="w-100"
        ></staff-commuting>
        <div class="row">
            <div class="col-12 w-100">
                <table class=".table form-group" style="width: 100%">
                    <tr style="background-color: YellowGreen; color: black;">
                        <td colspan=5>Grand Total</td>
                        <td style="text-align: right">{{ grandTotal }}</td>
                        <td class="grand-total-table-td">t CO2-eq/m parapet wall</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <previous-next-button
                        navigation-container="maintenance_container"
                ></previous-next-button>
            </div>
        </div>
    </div>
</template>

<script>
  import CfcMixins from '../mixins/dataHandling.js'
  import dataHandlingMixins from '../mixins/dataHandling.js'
  export default {
    mixins: [CfcMixins, dataHandlingMixins],
    props: {
      'tableId': {
        type: String
      },
      'firstTypeName': {
        type: String,
        default: 'Type of Material'
      },
      'firstMeasureName': {
        type: String,
        default: 'Quantity (ton/day)'
      },
      'secondTypeName': {
        type: String,
        default: 'Transportation'
      },
      'secondMeasureName': {
        type: String,
        default: 'Distance (km/day)'
      },
      'firstTemplateModel': {
        type: String,
        default: 'construction_materials'
      },
      'secondTemplateModel': {
        type: String,
        default: 'transport_materials'
      },
      'printHeader': {
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
        grandTotalC: 0,
        grandTotal: 0,
        columns: [],
        rowData: []
      }
    },
    created () {
      this.updateTemplateData()
    },
    methods: {
      updateTotalsAndEmit() {
        var totalCalculated = this.grandTotalA + this.grandTotalB + this.grandTotalC
        this.$emit('input', totalCalculated);
        this.grandTotal = totalCalculated
      }
    },
    watch: {
      grandTotalA() {
        this.updateTotalsAndEmit()
      },
      grandTotalB() {
        this.updateTotalsAndEmit()
      },
      grandTotalC() {
        this.updateTotalsAndEmit()
      }
    }
  }
</script>
