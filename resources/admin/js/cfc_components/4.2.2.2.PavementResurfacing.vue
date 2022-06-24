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
                <remove-existing-surface-with-days v-model="grandTotalA"
                                                   id="5145613265"
                                                   @productivity="setProductivity($event)"
                >
                </remove-existing-surface-with-days>
            </div>
            <div class="col-12">
                <h5>Scope 3: Indirect Emissions</h5>
                <h5>Embodied Carbon</h5>
                <h6>In construction materials</h6>
                <staff-commuting-with-indirect v-model="grandTotalB"
                                               first-column-name="Type of Material"
                                               second-column-name="(Ton/day)"
                                               template-data-model="construction_materials"
                                               :productivity="productivity"
                >
                </staff-commuting-with-indirect>
                <h6>In transport material</h6>
                <staff-commuting-with-indirect v-model="grandTotalC"
                                               first-column-name="Transportation"
                                               second-column-name="Distance (km/day)"
                                               template-data-model="transport_materials"
                                               :productivity="productivity"
                >
                </staff-commuting-with-indirect>
                <h6>In fuels used</h6>
                <staff-commuting-with-indirect v-model="grandTotalD"
                                               first-column-name="Type of Fuel"
                                               second-column-name="Fuel (l/day)"
                                               template-data-model="fuel"
                                               :productivity="productivity"
                >
                </staff-commuting-with-indirect>
            </div>
        </div>
        <div class="row">
            <div class="col-12 w-100">
                <table class=".table form-group w-100">
                    <tr style="background-color: YellowGreen; color: black;">
                        <td colspan=5>Grand Total</td>
                        <td align="right">{{ grandTotal }}</td>
                        <td class="grand-total-table-td">{{ grandTotalUnit }}</td>
                    </tr>
                </table>
            </div>
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
      'id': {
        type: String,
        default: ''
      },
      'grandTotalUnit': {
        type: String,
        default: 't CO2-eq'
      }
    },
    data: function() {
      return {
        stageTitle: '',
        criteriaTitle: '',
        subCriteriaTitle: '',
        superSubCriteriaTitle: '',
        instructions: '',
        productivity: 0,
        grandTotalA: 0,
        grandTotalB: 0,
        grandTotalC: 0,
        grandTotalD: 0,
        totalDistance: 0,
        totalSecondValue: 0,
        currentIdCounter: 0,
        grandTotal: 0,
        optionItems: [],
        columns: [],
        rowData: []
      }
    },
    methods: {
      setProductivity($event) {
        this.productivity = $event
      },
      updateTotalsAndEmit() {
        var totalCalculated = this.grandTotalA
          + this.grandTotalB
          + this.grandTotalC
          + this.grandTotalD
        this.$emit('input', totalCalculated);
        this.grandTotal = totalCalculated
      }
    },
    created () {
      this.updateTemplateData()
      this.$on('productivity', productivity => this.productivity = productivity)
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
      },
      grandTotalD() {
        this.updateTotalsAndEmit()
      }
    }
  }
</script>
