<template>
    <div class="row" style="margin-top: 39px;">
        <div class="col-6">
            <table class="table">
                <tr>
                    <td>Concessionaire Name</td>
                    <td><input type="text" :value="concessionaire ? concessionaire.name : ''" disabled></td>
                </tr>
                <tr>
                    <td>Date of assessment</td>
                    <td><input type="text" :value="assessment_year" disabled></td>
                </tr>
                <tr>
                    <td>Report Period</td>
                    <td><input type="text" :value="report_period" disabled></td>
                </tr>
                <tr>
                    <td>Evaluator Name</td>
                    <td>
                        <ol style="padding-left:18px;">
                            <li v-for="item in evaluators" :key="item.id">{{ item.user ? item.user.name : '' }}</li>
                        </ol>
                    </td>
                </tr>
            </table>
        </div>


        <div class="col-12"><hr></div>

        <div class="col-4">
            <div style="min-height: 80px">
                <h4 align="center">Planning & Design Highway</h4>
            </div>
            <div class="gauge gauge-lg center">
                <canvas class="donut-gauge" id="gauge-1" style="height: 100%; width: 100%"></canvas>
                <div class="gauge-label middle-label" id="gauge-label-1"></div>
            </div>
            <summary-table-sources
                    :data-values="planning_design_values"
            >
            </summary-table-sources>

        </div>
        <div class="col-4">
            <div style="min-height: 80px;"><h4 align="center">Construction Highway</h4></div>
            <div class="gauge gauge-lg">
                <canvas class="donut-gauge" height="250" width="500" id="gauge-2"></canvas>
                <div class="gauge-label middle-label" id="gauge-label-2"></div>
            </div>
            <summary-table-sources
                    :data-values="operation_design_values"
            >
            </summary-table-sources>
        </div>
        <div class="col-4">
            <div style="min-height: 80px"><h4 align="center">Operation & Maintenance Highway</h4></div>
            <div class="gauge gauge-lg">
                <canvas class="donut-gauge" height="250" width="500" id="gauge-3"></canvas>
                <div class="gauge-label middle-label" id="gauge-label-3"></div>
            </div>
            <summary-table-sources
                    :data-values="construction_values"
            >
            </summary-table-sources>
        </div>

        <div class="col-4">
            <div>
                <div class="card-body">
                    <div class="amcharts" id="3d-chart-1"></div>
                </div>
            </div>
        </div>

        <div class="col-4">
            <div class="card-body">
            <div class="amcharts" id="3d-chart-2"></div>
            </div>

        </div>
        <div class="col-4">
            <div class="card-body">
            <div class="amcharts" id="3d-chart-3"></div>
            </div>
        </div>

        <div class="col-xl-6">
            <table class="w-100">
                <tr>
                    <td colspan="3" style="text-align: center"><h4>Scope</h4></td>
                </tr>
                <tr><div style="display: block; height: 50px"></div></tr>
                <tr>
                    <td align="center">
                        <p><pre style='font-family: "Roboto", sans-serif; font-size: 1rem'>{{ scopeApercent }}</pre></p>
                        <select id="barrating1" class="bar-horizontal" name="rating" autocomplete="off" :value="scopeA">
                            <option value="10">10</option>
                            <option value="9">9</option>
                            <option value="8">8</option>
                            <option value="7">7</option>
                            <option value="6">6</option>
                            <option value="5">5</option>
                            <option value="4">4</option>
                            <option value="3">3</option>
                            <option value="2">2</option>
                            <option value="1" selected="selected">1</option>
                        </select>
                        <p>Scope 1</p>
                    </td>
                    <td align="center">
                        <p><pre style='font-family: "Roboto", sans-serif; font-size: 1rem'>{{ scopeBpercent }}</pre></p>
                        <select id="barrating2" class="bar-horizontal" name="rating" autocomplete="off" :value="scopeB">
                            <option value="10">10</option>
                            <option value="9">9</option>
                            <option value="8">8</option>
                            <option value="7">7</option>
                            <option value="6">6</option>
                            <option value="5">5</option>
                            <option value="4">4</option>
                            <option value="3">3</option>
                            <option value="2">2</option>
                            <option value="1" selected="selected">1</option>
                        </select>
                        <p>Scope 2</p>
                    </td>
                    <td align="center">
                        <p><pre style='font-family: "Roboto", sans-serif; font-size: 1rem'>{{ scopeCpercent }}</pre></p>
                        <select id="barrating3" class="bar-horizontal" name="rating" autocomplete="off" :value="scopeC">
                            <option value="10">10</option>
                            <option value="9">9</option>
                            <option value="8">8</option>
                            <option value="7">7</option>
                            <option value="6">6</option>
                            <option value="5">5</option>
                            <option value="4">4</option>
                            <option value="3">3</option>
                            <option value="2">2</option>
                            <option value="1" selected="selected">1</option>
                        </select>
                        <p>Scope 3</p>
                    </td>
                </tr>
            </table>
        </div>

        <div class="col-6 text-center">
            <h4>Total Emission</h4>
            <div class="card-body">
            <div class="amcharts" id="3d-chart-total"></div>
            </div>
        </div>


        <div class="col-8">
            <div class="amcharts" id="clust-bar-chart"></div>
        </div>
        <div class="col-4">
            <summary-table-sources
                    style="margin-top: 50px"
                    :data-values="total_values"
                    :print-header="header"
                    print-sum
            >
            </summary-table-sources>
        </div>
        <!--<div class="col-12 center w-100">-->
            <!--<button type="button" @click="updateCalculations($event)" class="btn btn-info">-->
                <!--Refresh-->
            <!--</button>-->
        <!--</div>-->
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
      'stageConstant': {
        type: Number,
        default: 0.8
      }
    },
    data () {
      return {
        name: '',
        concessionaire: project_data['concessionaire'],
        assessment_year: '',
        report_period: '',
        planning_design_percentage: [60, 40],
        construction_percentage: [50,50],
        operation_maintenance_percentage: [0, 0],
        planning_design_values: [],
        operation_design_values: [],
        construction_values: [],
        total_values: [],
        totals: [],
        planning_design_totals: [],
        operation_design_totals: [],
        construction_totals: [],
        scope_percentages: [],
        scopeA: 0,
        scopeB: 0,
        scopeC: 0,
        scopeApercent: 0,
        scopeBpercent: 0,
        scopeCpercent: 0,
        header: '',
        evaluators: [],
        stages_totals: null
      }
    },
    mounted: function () {
      window.setInterval(() => {
        if(needDataUpdate) {
          this.updateCalculations()
          needDataUpdate = false
        }
      }, 2500)
    },
    methods: {
      updateCalculations() {
        // create copy of partial_totals to work on this page
        var current_stage = $.extend(true, {}, stages_totals)
        // first sum 3 & 4
        var partial_electricity = current_stage[currentYearActive][3].electricity
        var partial_water = current_stage[currentYearActive][3].water
        var partial_transportation = current_stage[currentYearActive][3].transportation
        var partial_material = current_stage[currentYearActive][3].material
        var partial_machineries = current_stage[currentYearActive][3].machineries
        var partial_paper = current_stage[currentYearActive][3].paper
        var partial_waste = current_stage[currentYearActive][3].waste
        current_stage[currentYearActive][3].electricity = partial_electricity + current_stage[currentYearActive][4].electricity
        current_stage[currentYearActive][3].water = partial_water + current_stage[currentYearActive][4].water
        current_stage[currentYearActive][3].transportation = partial_transportation + current_stage[currentYearActive][4].transportation
        current_stage[currentYearActive][3].material = partial_material + current_stage[currentYearActive][4].material
        current_stage[currentYearActive][3].machineries = partial_machineries + current_stage[currentYearActive][4].machineries
        current_stage[currentYearActive][3].paper = partial_paper + current_stage[currentYearActive][4].paper
        current_stage[currentYearActive][3].waste = partial_waste + current_stage[currentYearActive][4].waste
        
        this.stages_totals = current_stage;

        this.name = project_data['name']
//        this.assessment_year = project_data['assessment_year']
        this.assessment_year = project_data['assessment_years'][currentYearActive]
        this.report_period = project_data['report_period']
        this.evaluators = project_data['evaluators']

        var stageConstant = this.$props.stageConstant
        var percentage = (project_data['planning_percentage'] / stageConstant)
        this.planning_design_percentage = [percentage, (100 - percentage)]
        percentage = (project_data['construction_percentage'] / stageConstant)
        this.construction_percentage = [percentage, (100 - percentage)]
        percentage = (project_data['existing_percentage'] / stageConstant)
        this.operation_maintenance_percentage = [percentage, (100 - percentage)]

        this.planning_design_values = this.copyTotalInputToValueVariable(this.stages_totals[currentYearActive][1])
        this.operation_design_values = this.copyTotalInputToValueVariable(this.stages_totals[currentYearActive][2])
        this.construction_values = this.copyTotalInputToValueVariable(this.stages_totals[currentYearActive][3])

        this.createGauge('gauge-1', this.getTotalForGauge(1), '', 'gauge-label-1')
        this.createGauge('gauge-2', this.getTotalForGauge(2), '', 'gauge-label-2')
        this.createGauge('gauge-3', this.getTotalForGauge(3), '', 'gauge-label-3')

        this.total_values = this.getTotalInputValue()
        this.operation_design_totals = this.copyTotalInputToTotalPercentageVariable(this.stages_totals[currentYearActive][1])
        this.planning_design_totals = this.copyTotalInputToTotalPercentageVariable(this.stages_totals[currentYearActive][2])
        this.construction_totals = this.copyTotalInputToTotalPercentageVariable(this.stages_totals[currentYearActive][3])

        var emissionA = this.getPieData(this.stages_totals[currentYearActive][1])
        var emissionB = this.getPieData(this.stages_totals[currentYearActive][2])
        var emissionC = this.getPieData(this.stages_totals[currentYearActive][3])
        this.handleTotalsPieChart('3d-chart-1', emissionA, 'Planning & Design stage')
        this.handleTotalsPieChart('3d-chart-2', emissionB, 'Construction Stage')
        this.handleTotalsPieChart('3d-chart-3', emissionC, 'O&M Stage')
        var totalEmission = this.getTotalEmissionPieData()
        this.handleTotalsPieChart('3d-chart-total', totalEmission, 'Total emission')
        this.totals = this.getTotalVariable()
        this.header = 'After the assessment review, it shows that  the highway '+project_data['name']+' release the emission of:'

        var data = this.getDataPerScope()
        this.handleClusterBarChart(data)

        var a = this.getTotalSumForInputRow(this.stages_totals[currentYearActive][1])
        var b = this.getTotalSumForInputRow(this.stages_totals[currentYearActive][2])
        var c = this.getTotalSumForInputRow(this.stages_totals[currentYearActive][3])
        var total = a + b + c
        var tmpa = 0
        var tmpb = 0
        var tmpc = 0

        if(total != 0) {

          if(a != null) {
            this.scopeA = Math.round((a / total) * 10).toString()
            $('#barrating1').barrating('set', this.scopeA);
            tmpa = (a / total) * 100
            this.changeBarRatingColor('barrating1', 'lightblue', 'blue')
          }
          if(b != null) {
            this.scopeB = b != null ? Math.round((b / total) * 10).toString() : ''
            $('#barrating2').barrating('set', this.scopeB);
            tmpb = (b / total) * 100
            this.changeBarRatingColor('barrating2', 'lightgreen', 'green')
          }
          if(c != null) {
            this.scopeC = c != null ? Math.round((c / total) * 10).toString() : ''
            $('#barrating3').barrating('set', this.scopeC);
            tmpc = (c / total) * 100
          }

          this.updateScoreAwardsTotals(a,b,c,total);
        }
        this.scope_percentages = [
          {'scope': 1, 'percent': tmpa},
          {'scope': 2, 'percent': tmpb},
          {'scope': 3, 'percent': tmpc}
        ]
        this.scopeApercent = tmpa.toFixed(2) + "%\n"+a.toFixed(4)+" tCO2e"
        this.scopeBpercent = tmpb.toFixed(2) + "%\n"+b.toFixed(4)+" tCO2e"
        this.scopeCpercent = tmpc.toFixed(2) + "%\n"+c.toFixed(4)+" tCO2e"
      },
      getPieData(input) {
        return [
          {
            'title': 'electricity',
            'total': input.electricity
          },
          {
            'title': 'water',
            'total': input.water
          },
          {
            'title': 'transportation',
            'total': input.transportation
          },
          {
            'title': 'material',
            'total': input.material
          },
          {
            'title': 'machineries',
            'total': input.machineries
          },
          {
            'title': 'paper',
            'total': input.paper
          },
          {
            'title': 'waste',
            'total': input.waste
          },
        ]
      },
      getTotalEmissionPieData() {
        var stageTotal = this.stages_totals[currentYearActive];
        return [
          {
            'title': 'electricity',
            'total': stageTotal[1].electricity + stageTotal[2].electricity + stageTotal[3].electricity
          },
          {
            'title': 'water',
            'total': stageTotal[1].water + stageTotal[2].water + stageTotal[3].water
          },
          {
            'title': 'transportation',
            'total': stageTotal[1].transportation + stageTotal[2].transportation + stageTotal[3].transportation
          },
          {
            'title': 'material',
            'total': stageTotal[1].material + stageTotal[2].material + stageTotal[3].material
          },
          {
            'title': 'machineries',
            'total': stageTotal[1].machineries + stageTotal[2].machineries + stageTotal[3].machineries
          },
          {
            'title': 'paper',
            'total': stageTotal[1].paper + stageTotal[2].paper + stageTotal[3].paper
          },
          {
            'title': 'waste',
            'total': stageTotal[1].waste + stageTotal[2].waste + stageTotal[3].waste
          },
        ]
      },
      getTotalVariable() {
        var partialTotal = this.getTotalInputValue()
        return this.getTotalInPercentage(partialTotal)
      },
      copyTotalInputToTotalPercentageVariable(input) {
        var partialTotal = this.copyTotalInputToValueVariable(input)
        partialTotal = this.getTotalInPercentage(partialTotal)
        return [
          {'title': 'Completed', 'size': partialTotal[0]},
          {'title': 'Remaining', 'size': partialTotal[1]},
        ]
      },
      getTotalInPercentage(partialTotal) {
        var total = [];
        var sum = 0;
        for(var i=0; i<partialTotal.length; i++) {
          sum += partialTotal[i]
        }
        for(var i=0; i<partialTotal.length; i++) {
          total[i] = Number.parseFloat(((partialTotal[i] / sum) * 100).toFixed(2))
        }
        return total
      },
      sumTotalForGauge(input) {
        var totalScopes = this.getTotalSumForInputRow(this.stages_totals[1])
            + this.getTotalSumForInputRow(this.stages_totals[2])
            + this.getTotalSumForInputRow(this.stages_totals[3])
        var currentScope = + this.getTotalSumForInputRow(this.stages_totals[input])
        return (currentScope / totalScopes) * 100

      },
      getTotalForGauge(input) {
        var a = 0;
        switch(input) {
          case 1:
            a = project_data['planning_percentage'];
            break;
          case 2:
            a = project_data['construction_percentage'];
            break;
          case 3:
            a = project_data['existing_percentage'];
            break;
        }
        return a / this.$props.stageConstant;
      },
      copyTotalInputToValueVariable(input) {
        var partialTotal = [
          input.electricity, input.water, input.transportation, input.material, input.machineries, input.paper, input.waste
        ]
        return partialTotal
      },
      getTotalSumForInputRow(input) {
        return input.electricity + input.water + input.transportation
            + input.material + input.machineries + input.paper + input.waste
      },
      getTotalInputValue() {
        var partialTotal = [
          this.stages_totals[currentYearActive][1].electricity + this.stages_totals[currentYearActive][2].electricity + this.stages_totals[currentYearActive][3].electricity,
          this.stages_totals[currentYearActive][1].water + this.stages_totals[currentYearActive][2].water + this.stages_totals[currentYearActive][3].water,
          this.stages_totals[currentYearActive][1].transportation + this.stages_totals[currentYearActive][2].transportation + this.stages_totals[currentYearActive][3].transportation,
          this.stages_totals[currentYearActive][1].material + this.stages_totals[currentYearActive][2].material + this.stages_totals[currentYearActive][3].material,
          this.stages_totals[currentYearActive][1].machineries + this.stages_totals[currentYearActive][2].machineries + this.stages_totals[currentYearActive][3].machineries,
          this.stages_totals[currentYearActive][1].paper + this.stages_totals[currentYearActive][2].paper + this.stages_totals[currentYearActive][3].paper,
          this.stages_totals[currentYearActive][1].waste + this.stages_totals[currentYearActive][2].waste + this.stages_totals[currentYearActive][3].waste,
        ]
        return partialTotal
      },
      getDataPerScope() {
        var stageTotal = this.stages_totals[currentYearActive];
        return [
          {
            'scope': 'Scope 1',
            'preplanning': stageTotal[1].transportation + stageTotal[1].machineries,
            'construction': stageTotal[1].electricity,
            'operation_maintenance': stageTotal[1].paper + stageTotal[1].waste + stageTotal[1].water
          },
          {
            'scope': 'Scope 2',
            'preplanning': stageTotal[2].transportation + stageTotal[2].machineries,
            'construction': stageTotal[2].electricity,
            'operation_maintenance': stageTotal[2].paper + stageTotal[2].waste + stageTotal[2].water
          },
          {
            'scope': 'Scope 3',
            'preplanning': stageTotal[3].transportation + stageTotal[3].machineries,
            'construction': stageTotal[3].electricity,
            'operation_maintenance': stageTotal[3].paper + stageTotal[3].waste + stageTotal[3].water
          }
        ]
      },
      handleClusterBarChart(currentData) {
        var clusterBarChart = AmCharts.makeChart('clust-bar-chart', {
          'type': 'serial',
          'categoryField': 'scope',
          'theme': 'light',
          'rotate': true,
          'startDuration': 1,
          'categoryAxis': {
            'gridPosition': 'start',
            'position': 'left'
          },
          'trendLines': [],
          'graphs': [
            {
              'balloonText': 'Pre-Planning:[[value]]',
              'fillAlphas': 0.8,
              'id': 'AmGraph-1',
              'lineAlpha': 0.2,
              'title': 'PrePlanning',
              'type': 'column',
              'valueField': 'preplanning'
            },
            {
              'balloonText': 'Construction:[[value]]',
              'fillAlphas': 0.8,
              'id': 'AmGraph-2',
              'lineAlpha': 0.2,
              'title': 'Construction',
              'type': 'column',
              'valueField': 'construction'
            },
            {
              'balloonText': 'OperationMaintenance:[[value]]',
              'fillAlphas': 0.8,
              'id': 'AmGraph-3',
              'lineAlpha': 0.2,
              'title': 'Operation',
              'type': 'column',
              'valueField': 'operation_maintenance'
            }
          ],
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
          'dataProvider': currentData,
          'export': {
            'enabled': false
          }
        });
      },
      createGauge(target, data, legend, gaugeLabel) {
        if(data == null || isNaN(data)) {
          data = 0
        }
        var optsDonuts = {
          angle: 0.35, // The span of the gauge arc
          lineWidth: 0.07, // The line thickness
          radiusScale: 1, // Relative radius
          limitMax: false,     // If false, the max value of the gauge will be updated if value surpass max
          limitMin: false,     // If true, the min value of the gauge will be fixed unless you set it manually
          colorStart: '#ffde00',   // Colors
          colorStop: '#00ff00',    // just experiment with them
          strokeColor: '#E0E0E0',  // to see which ones work best for you
          generateGradient: true,
          highDpiSupport: true,     // High resolution support
          axes: [{
            unit: '%'
          }]
        }
        target = '#' + target
        $(target).each(function () {
          if (optsDonuts !== false) {
            var donut = new Donut(this).setOptions(optsDonuts)
            donut.maxValue = 100 // set max gauge value
            donut.setMinValue(0)  // set min value
            donut.animationSpeed = 32 // set animation speed (32 is default value)
            donut.set(data) // set actual value
            $(target).css('height', '100%');
            $(target).css('width', '100%');

            var textRenderer = new TextRenderer(document.getElementById(gaugeLabel))
            textRenderer.render = function(donut) {
              var percentage = donut.displayedValue / donut.maxValue
              this.el.innerHTML = (percentage * 100).toFixed(2) + "%"
            };
            donut.setTextField(textRenderer);
          }
        });
      },
      handleTotalsPieChart(target, data, label) {
        var donutChart = AmCharts.makeChart(target, {
          'type': 'pie',
          'radius': 100,
          'theme': 'light',
          'dataProvider': data,
          'valueField': 'total',
          'titleField': 'title',
          'startEffect': 'elastic',
          'startDuration': 2,
          'labelRadius': 15,
          'innerRadius': '50%',
          'depth3D': 10,
          'angle': 15,
          'export': {
            'enabled': true
          },
          'categoryAxis': {
            'renderer': {
              'labels': {
                'template': {
                  'fontSize': 10
                }
              }
            }
          }
        })
      },
      changeBarRatingColor(id, color, baseColor) {
        $('#'+id).parent().find('div > a').css('background-color', color);
        $('#'+id).parent().find('div > a.br-selected').css('background-color', baseColor);
        $('.br-wrapper').css('padding-right', '28px');
      },
      updateScoreAwardsTotals(scope1, scope2, scope3, total) {
        var found = false;
        var newRow = this.getScoreAwardsTotalsNewRow(scope1, scope2, scope3, total, currentYearActive);
        var currentYearValue = project_data['assessment_years'][currentYearActive];
        for(var i = 0; i < project_data['score_awards_totals'].length; i++) {
          if(project_data['score_awards_totals'][i].year == currentYearValue) {
            project_data['score_awards_totals'][i] = newRow;
            found = true;
          }
        }
        if(!found) {
          console.log("pushing new row");
          project_data['score_awards_totals'].push(newRow);
        }
        needScoreUpdate = true;
      },
      getScoreAwardsTotalsNewRow(scope1, scope2, scope3, total, yearPosition) {
        return {
          'scope_1': scope1,
          'scope_2': scope2,
          'scope_3': scope3,
          'total': total,
          'year': project_data['assessment_years'][yearPosition]
        };
      }
    }
  }
</script>
