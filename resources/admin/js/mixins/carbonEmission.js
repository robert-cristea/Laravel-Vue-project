export default {
  methods: {
    updateCarbonEmission () {
      var total = 0
      for (var i = 0; i < this.rowData.length; i++) {
        total += this.getRowCarbonEmission(i)
      }
      this.totalCarbonEmission = total
      this.$emit('input', this.totalCarbonEmission);
    }
  }
}