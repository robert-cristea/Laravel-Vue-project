<template>
    <div class="row w-100">
        <div class="col-12">
            <table class="table table-sm form-group w-100">
                <tr>
                    <th :style="subStyle">No.</th>
                    <th :style="subStyle">{{ firstColumnName }}</th>
                    <th :style="subStyle">{{ secondColumnName }}</th>
                    <th :style="subStyle">Factor</th>
                    <th :style="subStyle">Unit</th>
                    <th :style="subStyle">Sources</th>
                    <th :style="subStyle"></th>
                </tr>
                <tr>
                    <th colspan="8" align="center" :style="subStyle">{{ subRowName }}</th>
                </tr>
                <tr v-for="(item, index) in rowData" :key="index">
                    <td>
                        {{ item.id }}
                    </td>
                    <td>
                        {{ item.category }}
                    </td>
                    <td>
                        {{ item.subcategory }}
                    </td>
                    <td>
                        {{ item.factor }}
                    </td>
                    <td>
                        {{ item.unit }}
                    </td>
                    <td>
                        {{ item.sources }}
                    </td>
                </tr>
            </table>
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
      'printHeader': {
        type: Boolean,
        default: false
      },
      'id': {
        type: String,
        default: ''
      },
      'headerTitle': {
        type: String,
        default: 'Emissions Factor'
      },
      'subStyle': {
        type: String,
        default: 'background-color: #4fc47f; color: white'
      },
      'formAction': {
        type: String,
        default: ''
      },
      'formCategoryTitle': {
        type: String,
        default: 'Category'
      },
      'formFactorTitle': {
        type: String,
        default: 'Emission Factor'
      },
      'formSubCategoryTitle': {
        type: String,
        default: 'Activity'
      },
      'firstColumnName': {
        type: String,
        default: 'Category'
      },
      'secondColumnName': {
        type: String,
        default: 'Activity'
      },
      'subRowName': {
        type: String,
        default: 'Utilities and Fuels'
      },
      'projectId': {
        default: 0
      },
      'token': {
        type: String,
        default: ''
      },
      'type': {
        default: 1
      }
    },
    data: function() {
      return {
        optionItems: [],
        rowData: []
      }
    },
    methods: {
      deleteElement (id) {
        axios.post('/admin/emission_factor/' + id, {
          data: project_data,
          _method: 'delete'
        })
          .then(function (response) {
            window.location.reload()
          })
          .catch(function (error) {
            console.error(error);
          });
      },
      warmData() {
        var emissionRows = project_data['emission_factor']
        var currentRows = []
        for(var i=0; i<emissionRows.length; i++) {
          if(emissionRows[i].type == this.$props.type) {
            currentRows.push(emissionRows[i])
          }
        }
        this.rowData = currentRows
      }
    },
    created () {
        this.warmData()
    }
  }
</script>
