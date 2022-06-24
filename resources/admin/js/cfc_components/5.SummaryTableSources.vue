<template>
    <div>
        <h5>{{ printHeader }}</h5>
        <table style="width: 100%">
            <tr>
                <th colspan="3" align="center">Source</th>
            </tr>
            <tr v-for="(item, index) in dataSources" :key="index">
                <td>{{ item }}</td>
                <td align="right">{{ dataValues[index] ? dataValues[index].toFixed(4) : '' }}</td>
                <td align="right">{{ unit }}</td>
            </tr>
        </table>
        <div v-if="printSum" style="margin-top: 10px">
            <h6>Total emission released</h6>
            <span>{{ total }} {{ unit }}</span>
        </div>
    </div>
</template>

<script>
  export default {
    props: {
      'dataSources': {
        type: Array,
        default() {
          return ['Electricity', 'Water', 'Transportation', 'Material', 'Machineries']
        }
      },
      'dataValues': {
        type: Array,
        default: [0, 0, 0, 0, 0, 0, 0]
      },
      'unit': {
        type: String,
        default: 't CO2e'
      },
      'printHeader': {
        type: String,
        default: ''
      },
      'printSum': {
        type: Boolean,
        default: false
      }
    },
    computed: {
      total() {
        var total = 0
        var values = this.$props.dataValues
        for(var i=0; i<values.length; i++) {
          total += values[i]
        }
        return total
      }
    }
  }
</script>
