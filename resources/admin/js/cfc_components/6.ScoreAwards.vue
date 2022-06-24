<template>
    <div class="row" style="margin-top: 39px;">
        <div class="col-12">
            <table class="table" v-if="currentYearActive == 0">
                <tr>
                    <th>#</th>
                    <th>Assessment year</th>
                    <th>Scope 1</th>
                    <th>Scope 2</th>
                    <th>Scope 3</th>
                    <th>All Scope</th>
                    <th></th>
                </tr>

                <tr v-for="row in score_awards_totals">
                    <td></td>
                    <td>{{ row.year }}</td>
                    <td>{{  convert_to_short(row.scope_1) }}</td>
                    <td>{{  convert_to_short(row.scope_2) }}</td>
                    <td>{{ convert_to_short(row.scope_3)  }}</td>
                    <td>{{ convert_to_short(row.total)  }}</td>
                    <td>t CO2e</td>
                </tr>

                <tr>
                    <td colspan="4"></td>
                    <td>Reduction</td>
                    <td>{{ reduction }} %</td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                    <td>Award</td>
                    <td>{{ award }}</td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                    <td colspan="3">
                        <button class="btn btn-success" v-if="userIsAuditor && latestYear" v-on:click="validateAndSaveProject">
                            Submit Score
                        </button>
                    </td>
                    <td></td>
                </tr>
            </table>
            <table class="table" v-else>
                <tr>
                    <th>#</th>
                    <th>Assessment year</th>
                    <th>Scope 1</th>
                    <th>Scope 2</th>
                    <th>Scope 3</th>
                    <th>All Scope</th>
                    <th></th>
                </tr>

                <tr>
                    <td></td>
                    <td>{{ score_awards_totals[0].year }}</td>
                    <td>{{ convert_to_short(score_awards_totals[0].scope_1) }}</td>
                    <td>{{ convert_to_short(score_awards_totals[0].scope_2 )}}</td>
                    <td>{{ convert_to_short(score_awards_totals[0].scope_3 )}}</td>
                    <td>{{ convert_to_short(score_awards_totals[0].total) }}</td>
                    <td>t CO2e</td>
                </tr>

                <tr>
                    <td></td>
                    <td>{{ score_awards_totals[currentYearActive].year }}</td>
                    <td>{{ score_awards_totals[currentYearActive].scope_1 }}</td>
                    <td>{{ score_awards_totals[currentYearActive].scope_2 }}</td>
                    <td>{{ score_awards_totals[currentYearActive].scope_3 }}</td>
                    <td>{{ score_awards_totals[currentYearActive].total }}</td>
                    <td>t CO2e</td>
                </tr>

                <tr>
                    <td colspan="4"></td>
                    <td>Reduction</td>
                    <td>{{ reduction }} %</td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                    <td>Award</td>
                    <td>{{ award }}</td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                    <td colspan="3">
                        <button class="btn btn-success" v-if="userIsAuditor && latestYear" v-on:click="validateAndSaveProject">
                            Submit Score
                        </button>
                    </td>
                    <td></td>
                </tr>
            </table>
        </div>

        <div class="col-12">
            <div class="amcharts" id="scope-award-bar-chart"></div>
        </div>

        <div class="col-12" v-if="userIsAuditor || userIsAdmin">
            ACHIEVEMENTS / CERTIFICATION LEVEL
            <table>
                <tr>
                    <td align="center" style="background-color: darkseagreen">CERTIFIED</td>
                    <td>
                        <input size="2" id="certified_1" name="certified_2" type="text" v-model.number="certified_1" v-if="userIsAdmin">
                        <input size="2" id="certified_1" name="certified_2" type="text" v-model.number="certified_1" disabled v-else>
                        -
                        <input size="2" id="certified_2" name="certified_2" type="text" v-model.number="certified_2" v-if="userIsAdmin">
                        <input size="2" id="certified_2" name="certified_2" type="text" v-model.number="certified_2" disabled v-else>
                        % of reduction
                    </td>
                </tr>
                <tr>
                    <td align="center" style="background-color: silver">SILVER</td>
                    <td>
                        <input size="2" id="silver_1" name="silver_1" type="text" v-model.number="silver_1" v-if="userIsAdmin">
                        <input size="2" id="silver_1" name="silver_1" type="text" v-model.number="silver_1" disabled v-else>
                        -
                        <input size="2" id="silver_2" name="silver_2" type="text" v-model.number="silver_2" v-if="userIsAdmin">
                        <input size="2" id="silver_2" name="silver_2" type="text" v-model.number="silver_2" disabled v-else>
                        % of reduction
                    </td>
                </tr>
                <tr>
                    <td align="center" style="background-color: darkgrey">GOLD</td>
                    <td>
                        <input size="2" id="gold_1" name="gold" type="text" v-model.number="gold_1" v-if="userIsAdmin">
                        <input size="2" id="gold_1" name="gold" type="text" v-model.number="gold_1" disabled v-else>
                        -
                        <input size="2" id="gold_2" name="gold" type="text" v-model.number="gold_2" v-if="userIsAdmin">
                        <input size="2" id="gold_2" name="gold" type="text" v-model.number="gold_2" disabled v-else>
                        % of reduction
                    </td>
                </tr>
                <tr>
                    <td align="center" style="background-color: gold">PLATINUM</td>
                    <td>
                        <input size="2" id="platinum_1" name="platinum" type="text" v-model.number="platinum_1" v-if="userIsAdmin">
                        <input size="2" id="platinum_1" name="platinum" type="text" v-model.number="platinum_1" disabled v-else>
                        -
                        <input size="2" id="platinum_2" name="platinum" type="text" v-model.number="platinum_2" v-if="userIsAdmin">
                        <input size="2" id="platinum_2" name="platinum" type="text" v-model.number="platinum_2" disabled v-else>
                        % of reduction
                    </td>
                </tr>
            </table>
        </div>
    </div>
</template>

<script>
  import SaveProjectMixin from '../mixins/saveProject.js'
  export default {
    mixins: [SaveProjectMixin],
    data () {
      return {
        userIsAuditor: userIsAuditor,
        userIsAdmin: userIsAdmin,
        certified_1: project_data['certified_1'],
        certified_2: project_data['certified_2'],
        silver_1: project_data['silver_1'],
        silver_2: project_data['silver_2'],
        gold_1: project_data['gold_1'],
        gold_2: project_data['gold_2'],
        platinum_1: project_data['platinum_1'],
        platinum_2: project_data['platinum_2'],
        score_awards_totals: project_data['score_awards_totals'],
        currentYearActive: currentYearActive
      }
    },
    mounted: function () {
      window.setInterval(() => {
        if(needScoreUpdate) {
          this.refreshScreen()
          needScoreUpdate = false
        }
      }, 2500)
    },
    methods: {
      refreshScreen() {
        this.refreshOnCalculationChange();
        this.handleClusterBarChart(this.score_awards_totals);
      },
        convert_to_short(val){
            return val.toFixed(4);
        },
      handleClusterBarChart(currentData) {
        var graphData = [
          {'title': 'Scope 1'},
          {'title': 'Scope 2'},
          {'title': 'Scope 3'}
        ];
        var graphSections = [];
        for(var i=0; i < currentData.length; i++) {
          graphData[0][currentData[i].year] = currentData[i].scope_1;
          graphData[1][currentData[i].year] = currentData[i].scope_2;
          graphData[2][currentData[i].year] = currentData[i].scope_3;
        }
        var id = 0;
        for(var i=0; i < currentData.length; i++) {
          graphSections.push({
            'valueField': currentData[i].year,
            'balloonText': currentData[i].year+' :[[value]]',
            'fillAlphas': 0.8,
            'id': 'AmGraph-'+id,
            'lineAlpha': 0.2,
            'title': 'Scope '+(id+1),
            'type': 'column',
          });
          id++;
        }
        var clusterBarChart = AmCharts.makeChart('scope-award-bar-chart', {
          'type': 'serial',
          'categoryField': 'title',
          'theme': 'light',
          'rotate': true,
          'startDuration': 1,
          'categoryAxis': {
            'gridPosition': 'start',
            'position': 'left'
          },
          'trendLines': [],
          'graphs': graphSections,
          'guides': [],
          'valueAxes': [
            {
              'id': 'ValueAxis-1',
              'position': 'top',
              'axisAlpha': 0
            }
          ],
          'allLabels': [],
          'balloon': {},
          'titles': [],
          'dataProvider': graphData,
          'export': {
            'enabled': false
          }
        });
      },
      calculateReduction() {
        var lastYear = (this.currentYearActive == 0) ? this.score_awards_totals.length - 1 : this.currentYearActive;
        try {
          var first = this.score_awards_totals[0];
          var last = this.score_awards_totals[lastYear];
          var value = (last['total'] - first['total']) / first['total'];
          return (Math.abs(value) * 100).toFixed(2);
        }
        catch(e) {
          console.log("Score&Awards: Reduction set to 0 due to lack of data");
          var result = 0;
          return result.toFixed(2);
        }
      },
      validateAndSaveProject() {
        try {
          validateSection(project_data.section_verification[currentYearActive], "");

          this.saveProject();
          window.location.href = '/admin/projects';
        }
        catch(e) {
          var year = project_data.assessment_years[currentYearActive];
          alert("Unable to submit score. Failed section: year "+year+", section "+e.substring(1));
        }
      },
      refreshOnCalculationChange() {
        if(this.score_awards_totals[currentYearActive] == null) {
          this.score_awards_totals[currentYearActive] = {
            year: project_data['assessment_years'][currentYearActive],
            scope_1: 0,
            scope_2: 0,
            scope_3: 0,
            total: 0
          }
          project_data['score_awards_totals'][currentYearActive] = {
            year: project_data['assessment_years'][currentYearActive],
            scope_1: 0,
            scope_2: 0,
            scope_3: 0,
            total: 0
          }
        }
        this.score_awards_totals.sort(function(a,b) {
          if (a.year < b.year) {
            return -1;
          }
          else if (a.year > b.year) {
            return 1;
          }
          return 0;
        })
        for(var i=0; i < this.score_awards_totals.length; i++) {
          if(this.score_awards_totals[i].year == project_data['assessment_years'][currentYearActive]) {
            this.currentYearActive = i;
            break;
          }
        }
      }
    },
    created() {
        this.refreshOnCalculationChange();
    },
    watch: {
      certified_1() {
        project_data['certified_1'] = this.certified_1;
      },
      certified_2() {
        project_data['certified_2'] = this.certified_2;
      },
      silver_1 () {
        project_data['silver_1'] = this.silver_1;
      },
      silver_2() {
        project_data['silver_2'] = this.silver_2;
      },
      gold_1() {
        project_data['gold_1'] = this.gold_1;
      },
      gold_2() {
        project_data['gold_2'] = this.gold_2;
      },
      platinum_1() {
        project_data['platinum_1'] = this.platinum_1;
      },
      platinum_2() {
        project_data['platinum_2'] = this.platinum_2;
      }
    },
    computed: {
      reduction() {
        return this.calculateReduction();
      },
      latestYear() {
        return currentYearActive == this.score_awards_totals.length;
      },
      award() {
        var award = '';
        if(this.reduction >= this.certified_1 && this.reduction <= this.certified_2) {
          award = 'Certified';
        }
        else if(this.reduction >= this.silver_1 && this.reduction <= this.silver_2) {
          award = 'Silver';
        }
        else if(this.reduction >= this.gold_1 && this.reduction <= this.gold_2) {
          award = 'Gold';
        }
        else if(this.reduction >= this.platinum_1 && this.reduction <= this.platinum_2) {
          award = 'Platinum';
        }
        project_data['award'] = award;
        return award;
      }
    }
  }
</script>
