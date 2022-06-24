<template>
    <table class="table table-sm form-group w-100">
        <tr>
            <td>Concessionaires:</td>
            <td><input type="text" name="concessionaires" :value="concessionaire ? concessionaire.name : ''" class="form-control" disabled></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr v-if="withExistingHighwayPercent">
            <td>Existing Highway:</td>
            <td><input type="text" name="existing-highway" v-model="existingHighway" class="form-control" disabled></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Section/Package - Contractor:</td>
            <td><input type="text" name="section" v-model="section" class="form-control"></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Person in charge - position:</td>
            <td><input type="text" name="person_in_charge" v-model="person_in_charge" class="form-control"></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Date:</td>
            <td><input type="text" name="date_start" :id="tableId+'date_start'" v-model="date_start" class="form-control"></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr v-if="usePeriodOfReport">
            <td>Period of Report:</td>
            <td><input type="text" name="productivity" v-model.number="productivity" class="form-control"></td>
            <td>{{ periodOfReportUnit }}</td>
        </tr>
        <tr v-else>
            <td>Average work productivity for</td>
            <td><input type="text" name="productivity_days" v-model.number="productivity_days" class="form-control"></td>
            <td>day</td>
            <td><input type="text" v-model.number="productivity" class="form-control"></td>
            <td>{{ productivityUnit }}</td>
        </tr>
    </table>
</template>

<script>
  export default {
    props: {
      'usePeriodOfReport': {
        type: Boolean,
        default: false
      },
      'periodOfReportUnit': {
        type: String,
        default: 'year'
      },
      'productivityUnit': {
        type: String,
        default: 'm3'
      },
      'tableId': {
        type: String,
        default: ''
      },
      'id': {
        type: String,
        default: ''
      },
      'withExistingHighwayPercent': {
        type: Boolean,
        default: false
      }
    },
    data: function() {
      return {
        concessionaires: '',
        concessionaire: project_data['concessionaire'],
        existingHighway: '',
        section: '',
        person_in_charge: '',
        date_start: null,
        productivity_days: 0,
        productivity: 0
      }
    },
    methods: {
      warmData() {
        var storageSection = 'construction_header'
        var pathIds = this.getPathIds();
        var a = pathIds.length >= 1 ? pathIds[0] : null;
        var b = pathIds.length >= 2 ? pathIds[1] : null;
        var c = pathIds.length >= 3 ? pathIds[2] : null;
        var d = pathIds.length >= 4 ? pathIds[3] : null;
        var settings = project_data[storageSection];
        if(settings === null) {
          return;
        }
        var info = null;
        if(pathIds.length === 4 && settings[a] != null && settings[a][b] != null && settings[a][b][c] != null && settings[a][b][c][d] != null) {
          info = settings[a][b][c][d]
        }
        else if(pathIds.length === 3 && settings[a] != null && settings[a][b] != null && settings[a][b][c] != null) {
          info = settings[a][b][c]
        }
        else if(pathIds.length === 2 && settings[a] != null && settings[a][b] != null) {
          info = settings[a][b]
        }
        else if(pathIds.length === 1 && settings[a] != null) {
          info = settings[a]
        }
        if(info == null) {
          return;
        }
        this.concessionaires = info.concessionaires
        this.section = info.section
        this.person_in_charge = info.person_in_charge
        this.date_start = info.date_start
        this.productivity_days = info.productivity_days
        this.productivity = info.productivity
      },
        storeProjectStructureForConstructionTable() {
          var storageSection = 'construction_header'

          var pathIds = this.getPathIds();
          var a = pathIds.length >= 1 ? pathIds[0] : null;
          var b = pathIds.length >= 2 ? pathIds[1] : null;
          var c = pathIds.length >= 3 ? pathIds[2] : null;
          var d = pathIds.length >= 4 ? pathIds[3] : null;
          for(var i=0; i < pathIds.lenght; i++) {
            pathIds[i] = Number.parseInt(pathIds[i]);
          }
          var structureToStore = {
            concessionaires: this.concessionaires,
            section: this.section,
            person_in_charge: this.person_in_charge,
            date_start: this.date_start,
            productivity_days: this.productivity_days,
            productivity: this.productivity
          }
          if(project_data[storageSection] == null) {
            project_data[storageSection] = []
          }
          if(pathIds.length === 4) {
            if(project_data[storageSection][a] == null) {
              project_data[storageSection][a] = []
            }
            if(project_data[storageSection][a][b] == null) {
              project_data[storageSection][a][b] = []
            }
            if(project_data[storageSection][a][b][c] == null) {
              project_data[storageSection][a][b][c] = []
            }
            project_data[storageSection][a][b][c][d] = structureToStore
          }
          else if(pathIds.length === 3) {
            if(project_data[storageSection][a] == null) {
              project_data[storageSection][a] = []
            }
            if(project_data[storageSection][a][b] == null) {
              project_data[storageSection][a][b] = []
            }
            project_data[storageSection][a][b][c] = structureToStore
          }
          else if(pathIds.length === 2) {
            if(project_data[storageSection][a] == null) {
              project_data[storageSection][a] = []
            }
            project_data[storageSection][a][b] = structureToStore
          }
          else if(pathIds.length === 1) {
            project_data[storageSection][a] = structureToStore
          }
        },
      getPathIds() {
        var paths = this.$props.tableId.split(".");
        for (var i = 0; i < paths.length; i++) {
          paths[i] = paths[i].toString();
        }
        return paths;
      }
    },
    watch: {
      concessionaires() {
        this.storeProjectStructureForConstructionTable()
      },
      section() {
        this.storeProjectStructureForConstructionTable()
      },
      person_in_charge() {
        this.storeProjectStructureForConstructionTable()
      },
      date_start() {
        this.storeProjectStructureForConstructionTable()
      },
      productivity_days() {
        this.storeProjectStructureForConstructionTable()
      },
      productivity() {
        this.storeProjectStructureForConstructionTable()
        this.$emit('input', this.productivity)
      }
    },
    created () {
      this.warmData();
      this.concessionaires = project_data['name']
      this.existingHighway = project_data['existing_percentage']
    }
  }
</script>
