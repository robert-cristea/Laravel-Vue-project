<template>
    <div class="row" style="margin-bottom: 16px">
        <div class="col-12 form-inline">
            <label class="mr-2">Assessment Year</label>
            <select class="form-control" value="" v-model="selectedYear" style="min-width: 80px;">
                <option v-for="(year, value) in years" :value="value" :key="value">
                    {{ year }}
                </option>
            </select>
        </div>
    </div>
</template>

<script>
  export default {
    props: {
      'tableId': {
        type: String,
        default: ''
      },
      'id': {
        type: String,
        default: ''
      }
    },
    data: function() {
      return {
        years: project_data.assessment_years,
        selectedYear: currentYearActive
      }
    },
    watch: {
      selectedYear() {
        var urlPart = window.location.href.split("?")[0]
        window.location.href = urlPart + '?year='+this.selectedYear;
      }
    }
  }
</script>
