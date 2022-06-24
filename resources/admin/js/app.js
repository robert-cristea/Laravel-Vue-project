import Vue from 'vue'
import BarChart from './components/BarChart.vue'
import LineChart from './components/LineChart.vue'
import PieChart from './components/PieChart.vue'
import OfficeDesign from './cfc_components/1.PlanningDesign.vue'
import StaffCommuting from './cfc_components/1.1.1.StaffCommuting.vue'
import StaffCommutingWithIndirect from './cfc_components/1.1.1.StaffCommutingWithIndirect.vue'
import FleetVehicle from './cfc_components/1.1.2.FleetVehicle.vue'
import FleetVehicleA from './cfc_components/1.1.2.FleetVehicle_a.vue'
import ElectricConsumption from './cfc_components/1.1.3.ElectricConsumption.vue'
import PaperUsed from './cfc_components/1.1.6.PaperUsed.vue'
import Construction from './cfc_components/2.Construction.vue'
import Operation from './cfc_components/3.Operation.vue'
import Maintenance from './cfc_components/4.Maintenance.vue'
import SignBoardCleaning from './cfc_components/4.6.1.SignBoardCleaning.vue'
import SignBoardCleaningA from './cfc_components/4.6.1.SignBoardCleaningA.vue'
import SignBoardCleaningB from './cfc_components/4.6.1.SignBoardCleaningB.vue'
import CarbonSequestration from './cfc_components/4.1.1.CarbonSequestration.vue'
import RemoveExistingSurface from './cfc_components/4.2.1.1.RemoveExistingSurface.vue'
import RemoveExistingSurfaceWithDays from './cfc_components/4.2.2.1.RemoveExistingSurface.vue'
import PavementResurfacing from './cfc_components/4.2.1.2.PavementResurfacing.vue'
import PavementResurfacingWith3RowsInScope3 from './cfc_components/4.2.2.2.PavementResurfacing.vue'
import RoadMarking from './cfc_components/4.2.1.3.RoadMarking.vue'
import Landscaping from './cfc_components/4.1.3.Landscaping.vue'
import RemoveSurcharge from './cfc_components/2.2.1.RemoveSurcharge.vue'
import RemoveSurchargeStandardForm from './cfc_components/2.2.1.RemoveSurchargeStandardForm.vue'
import RemoveSurchargeReducedForm from './cfc_components/2.2.1.RemoveSurchargeReducedForm.vue'
import RemoveSurchargeElectricityForm from './cfc_components/2.2.1.RemoveSurchargeElectricityForm.vue'
import BoredPile from './cfc_components/2.8.1.1.BoredPile.vue'
import CaissonPile from './cfc_components/2.8.1.4.CaissonPile.vue'
import Tunnel from './cfc_components/2.12.Tunnel.vue'
import ExcavationTemporaryEarthDrain from './cfc_components/2.6.1.ExcavationTemporaryEarthDrain.vue'
import ElectricalConsumption from './cfc_components/2.1.2.ElectricalConsumption.vue'
import ElectricalConsumptionTable from './cfc_components/2.1.2.ElectricalConsumptionTable.vue'
import ConstructionStaffCommuting from './cfc_components/2.1.1.StaffCommuting.vue'
import ConstructionStaffCommutingTable from './cfc_components/2.1.1.StaffCommutingTable.vue'

import ConstructionDatabase from './cfc_components/2.ConstructionDatabase.vue'

import ConstructionHeaderForm from './cfc_components/ConstructionHeaderForm.vue'

import Home from './cfc_components/0.Home.vue'
import SaveButton from './components/SaveButton.vue'
import Evaluators from './cfc_components/Evaluators.vue'

import EmissionFactorTable from './cfc_components/EmissionFactor.vue'

import Summary from './cfc_components/5.Summary.vue'
import SummaryTableSources from './cfc_components/5.SummaryTableSources.vue'

import PreviousNextButton from './components/PreviousNextButton.vue'

import MainSectionHeader from './cfc_components/MainSectionHeader.vue'
import YearSelector from './cfc_components/YearSelector.vue'

import ScoreAwards from './cfc_components/6.ScoreAwards.vue'

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap')

window.Vue = Vue

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

window.Vue.component('bar-chart', BarChart)
window.Vue.component('line-chart', LineChart)
window.Vue.component('pie-chart', PieChart)
window.Vue.component('office-design', OfficeDesign)
window.Vue.component('staff-commuting', StaffCommuting)
window.Vue.component('staff-commuting-with-indirect', StaffCommutingWithIndirect)
window.Vue.component('fleet-vehicle', FleetVehicle)
window.Vue.component('fleet-vehicle-a', FleetVehicleA)
window.Vue.component('electric-consumption', ElectricConsumption)
window.Vue.component('paper-used', PaperUsed)
window.Vue.component('construction', Construction)
window.Vue.component('operation', Operation)
window.Vue.component('maintenance', Maintenance)
window.Vue.component('signboard-cleaning', SignBoardCleaning)
window.Vue.component('signboard-cleaning-a', SignBoardCleaningA)
window.Vue.component('signboard-cleaning-b', SignBoardCleaningB)
window.Vue.component('carbon-sequestration', CarbonSequestration)
window.Vue.component('remove-existing-surface', RemoveExistingSurface)
window.Vue.component('remove-existing-surface-with-days', RemoveExistingSurfaceWithDays)
window.Vue.component('pavement-resurfacing', PavementResurfacing)
window.Vue.component('pavement-resurfacing-with-3-rows-in-scope-3', PavementResurfacingWith3RowsInScope3)
window.Vue.component('road-marking', RoadMarking)
window.Vue.component('landscaping', Landscaping)
window.Vue.component('remove-surcharge', RemoveSurcharge)
window.Vue.component('remove-surcharge-standard-form', RemoveSurchargeStandardForm)
window.Vue.component('remove-surcharge-reduced-form', RemoveSurchargeReducedForm)
window.Vue.component('remove-surcharge-electricity-form', RemoveSurchargeElectricityForm)
window.Vue.component('bored-pile', BoredPile)
window.Vue.component('caisson-pile', CaissonPile)
window.Vue.component('tunnel', Tunnel)
window.Vue.component('excavation-temporary-earth-drain', ExcavationTemporaryEarthDrain)
window.Vue.component('electrical-consumption', ElectricalConsumption)
window.Vue.component('electrical-consumption-table', ElectricalConsumptionTable)
window.Vue.component('electrical-consumption', ElectricalConsumption)
window.Vue.component('construction-staff-commuting', ConstructionStaffCommuting)
window.Vue.component('construction-staff-commuting-table', ConstructionStaffCommutingTable)

window.Vue.component('construction-database', ConstructionDatabase)

window.Vue.component('home', Home)
window.Vue.component('save-button', SaveButton)
window.Vue.component('evaluators', Evaluators)

window.Vue.component('emission-factor-table', EmissionFactorTable)

window.Vue.component('summary-tab', Summary) 
window.Vue.component('summary-table-sources', SummaryTableSources)

window.Vue.component('construction-header-form', ConstructionHeaderForm)

window.Vue.component('previous-next-button', PreviousNextButton)

window.Vue.component('main-section-header', MainSectionHeader)

window.Vue.component('year-selector', YearSelector)

window.Vue.component('score-awards', ScoreAwards)

let app = new window.Vue({
  el: '#app'
})

let saver = new window.Vue({
  mixins: [SaveButton]
});
window.saver = saver;