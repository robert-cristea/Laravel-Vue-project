export default {
  methods: {
    updateTotalsAndEmit() {
      var totalCalculated = this.grandTotalA + this.grandTotalB;
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
    }
  }
}