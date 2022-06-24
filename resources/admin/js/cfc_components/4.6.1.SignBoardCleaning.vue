<!-- Copy of FleetVehicle -->
<!-- Select a text + FleetVehicleA -->
<!-- Select a text + StaffCommuting -->
<template>
    <div class="w-100">
        <h4>{{ criteriaTitle }}</h4>
        <h4>{{ subCriteriaTitle }}</h4>
        <h5>{{ superSubCriteriaTitle }}</h5>

        <div style="background-color: cyan;">
            {{ instructions }}
        </div>

        <div>
            <h5>Method (A): Fuel Based Method</h5>
        </div>
        <signboard-cleaning-a
                :table-id="tableId"
                :activity-data-model="activityDataModel"
                :template-data-model="templateDataModel"
                id="fleet-a"
                key="fleet-a"
                v-model="grandTotalA"
                class="w-100"
        ></signboard-cleaning-a>
        <div>
            <h5>Method (B): Distance Based Method</h5>
        </div>
        <signboard-cleaning-b
                :table-id="tableId"
                :activity-data-model="activityDataModel"
                :template-data-model="templateDataModel"
                first-column-name="Machineries / Transportation"
                id="fleet"
                key="fleet"
                v-model="grandTotalB"
                class="w-100"
        ></signboard-cleaning-b>
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
  import CfcMixins from '../mixins/dataHandling.js'
  import dataHandlingMixins from '../mixins/dataHandling.js'
  import grandTotalSum from '../mixins/grandTotalSum'
  export default {
    mixins: [CfcMixins, dataHandlingMixins, grandTotalSum],
    props: {
      'templateDataModel': {
        type: String,
        default: 'machinery_work'
      },
      'activityDataModel': {
        type: String,
        default: 'activities'
      },
      'tableId': {
        type: String,
        default: '4.6.1'
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
        grandTotal: 0,
        rowData: []
      }
    },
    methods: {
      updateGrandTotalA(value) {
        this.grandTotalA = value;
      }
    },
    created () {
      this.updateTemplateData()
    }
  }
</script>
