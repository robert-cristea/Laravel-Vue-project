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
            </div>
        </div>
        <div class="row">
            <div class="col-12 w-100">
                <table class=".table form-group" style="width: 100%">
                    <tr style="background-color: YellowGreen; color: black;">
                        <td colspan=5>Grand Total</td>
                        <td align="right">{{ grandTotal }}</td>
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
  import dataHandlingMixins from '../mixins/dataHandling.js'
  import grandTotalSum from '../mixins/grandTotalSum'
  export default {
    mixins: [dataHandlingMixins, grandTotalSum],
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
      }
    },
    created () {
      this.updateTemplateData()
      this.$on('productivity', productivity => this.productivity = productivity)
    }
  }
</script>
