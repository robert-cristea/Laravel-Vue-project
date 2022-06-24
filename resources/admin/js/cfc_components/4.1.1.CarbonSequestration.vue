<script>
  import StaffCommuting from './1.1.1.StaffCommuting.vue'
  import template from '../../../../public/assets/admin/js/template'
  export default {
    extends: StaffCommuting,
    methods: {
      getRowCarbonEmission(i) {
        var rowData = this.rowData[i]
        var carbon_emission = 0
        var emission_factor = rowData.emission_factor
        var distance = rowData.distance
        var density = template_data['data'][this.$props.templateDataModel][rowData.option].density
        var dryWeight = 1.28
        var convertBiomassIntoKilogramsOfCarbon = 0.5
        var convertToCarbonDioxide = 3.67
        if (emission_factor !== 0 && distance !== 0) {
          carbon_emission = distance * emission_factor * dryWeight
            * convertBiomassIntoKilogramsOfCarbon
            * convertToCarbonDioxide * density * 0.001
          rowData.carbon_emission = carbon_emission
          this.$set(this.rowData, i, rowData)
        }
        return carbon_emission
      }
    }
  }
</script>
