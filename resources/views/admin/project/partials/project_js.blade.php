<script type="text/javascript">
  var currentYearActive = {!! Request::get('year', 0) !!};
  var authUser = {!! Auth::user() !!};
  var userIsAdmin = {!! Auth::user()->isAdminRole() ? "true" : "false" !!};
  var userIsAuditor = {!! Auth::user()->isAuditor() ? "true" : "false" !!};
  var userIsConcessionaire = {!! Auth::user()->isConcessionaire() ? "true" : "false" !!};
  var targetPdfPath = '/assets/admin/project_pdf/';
  var deleteYearUrl = '{{ route('project.assessment_year.delete') }}';
  var template_data = {
    'stages': {!! json_encode($sheet_structure) !!},
    'data': {!! json_encode($global_data) !!},
  };

  var project_data = {
    'id': {{ $project->id }},
    'name': "{{ $project->name }}",
    'concessionaire': {!! json_encode($project->concessionaire) !!},
    'route': "{{ $project->route }}",
    'award': "{{ $project->award }}",
    'assessment_year': "{{ $project->assessment_year }}",
    'report_period': {{ $project->report_period }},
    'years': {{ $project->report_period }},
    'planning_percentage': {{ $project->planning_percentage }},
    'construction_percentage': {{ $project->construction_percentage }},
    'existing_percentage': {{ $project->existing_percentage }},
    'settings': JSON.parse({!! json_encode($project->settings) !!}),
    'construction_header': JSON.parse({!! json_encode($project->construction_header) !!}),
    'construction_footer': JSON.parse({!! json_encode($project->construction_footer) !!}),
    'construction_work_values': JSON.parse({!! json_encode($project->construction_work_values) !!}),
    'evaluators': {!! $project->evaluatorsList->load("user") !!},
    'emission_factor': [
            @foreach($project->emission_factors as $emission)
            @if($emission->factor)
      {
        id: {{ $emission->id }},
        category: "{{ $emission->category }}",
        subcategory: "{{ $emission->subcategory }}",
        factor: {!! str_replace(",", ".", $emission->factor) !!},
        unit: "{{ $emission->unit }},",
        sources: "{{ $emission->sources }},",
        type: {{ $emission->type }}
      },
        @endif
        @endforeach
    ],
    'assessment_years': {!! json_encode($project->assessment_years) !!},
    'section_verification': JSON.parse({!! json_encode($project->section_verification) !!}),
    'section_pdf': JSON.parse({!! json_encode($project->section_pdf) !!}),
	  'section_status': JSON.parse({!! json_encode($project->section_status) !!}),
	  'section_comment': JSON.parse({!! json_encode($project->section_comment) !!}),
    'certified_1': {{ $project->certified_1 }},
    'certified_2': {{ $project->certified_2 }},
    'silver_1': {{ $project->silver_1 }},
    'silver_2': {{ $project->silver_2 }},
    'gold_1': {{ $project->gold_1 }},
    'gold_2': {{ $project->gold_2 }},
    'platinum_1': {{ $project->platinum_1 }},
    'platinum_2': {{ $project->platinum_2 }},
    'score_awards_totals': JSON.parse({!! json_encode($project->score_awards_totals) !!})
  };
  template_data['data']['emission_factor__vehicle'] = {}
  for(var i=0; i<project_data.emission_factor.length; i++) {
    var newRow = project_data.emission_factor[i]
    if(newRow.type != 2) {
      continue
    }
    newRow.distance = newRow.factor
    newRow.title = newRow.subcategory
    template_data['data']['emission_factor__vehicle'][newRow.id] = newRow
  }
  template_data['data']['maintenance'] = {
    1: {
      'id': 1,
      'title': 'Pump and Genset / Electrical Consumption',
    },
    2: {
      'id': 2,
      'title': 'Desilting'
    },
    3: {
      'id': 3,
      'title': 'Methane'
    }
  };
  template_data['data']['activities'] = {
    'Signboard Cleaning': {
      'id': 'Signboard Cleaning',
      'title': 'Signboard Cleaning'
    },
    'Guidepost Cleaning': {
      'id': 'Guidepost Cleaning',
      'title': 'Guidepost Cleaning'
    }
  };
  needDataUpdate = 2;
  needScoreUpdate = true;

  var stageTotalStructure = {
    electricity: 0,
    water: 0,
    transportation: 0,
    material: 0,
    machineries: 0,
    paper: 0,
    waste: 0
  }
  var stagesTotalStructure = {
    1: Object.assign({}, stageTotalStructure),
    2: Object.assign({}, stageTotalStructure),
    3: Object.assign({}, stageTotalStructure),
    4: Object.assign({}, stageTotalStructure)
  }
  var stages_totals = {};
  for(var i=0; i < project_data.assessment_years.length; i++) {
    stages_totals[i] = stagesTotalStructure;
  }

  function switchTab(tab) {
    tabsToEnable = tab.split(",")
    for (var i=0; i<tabsToEnable.length; i++) {
      $('.nav-tabs a[href="#' + tabsToEnable[i] + '"]').tab('show');
    }
  }
  function saveAndSwitch(tab) {
    // trigger save
    switchTab(tab);
  }
  // new functions
  function addAssessmentYear() {
    try {
      validateLastYear();
      $("<tr>" +
        "<td>Year of assessment</td>" +
        "<td><input id='assessment_years[]' name='assessment_years[]' type='text' class='form-control' value=''></td>" +
        "<td><button class='btn btn-error' onclick='$.parent().parent().delete()'>Delete</button></td>" +
        "</tr>")
        .insertBefore('#addAssessmentYearButton');
    }
    catch(e) {
        alert("Unable to add new year until all previous assessment year sections are verified."
          + "Section not verified: "+e);
    }
  }

  function validateLastYear() {
    return true;
    try {
      for (var i = 0; i < project_data.section_verification.length; i++) {
        validateSection(project_data.section_verification[i], "");
      }
    }
    catch(e) {
      var year = project_data.assessment_years[i];
      throw "year "+year+", section "+e.substring(1);
    }
  }

  function validateSection(section, sectionText) {
    for (var [key, value] of Object.entries(section)) {
        var currentSectionText = sectionText + "." + key;
        if(typeof value === 'boolean' && !value) {
          throw currentSectionText;
        }
        else if(typeof value === 'object') {
          validateSection(value, currentSectionText)
        }
    }
    return true;
  }

  function deleteAssessmentYear(year) {
    window.location.href = deleteYearUrl + '?delete='+year+'&project_id='+{{ $project->id }};
  }

  function verifySection(stage, section, subsection=null, supersubsection=null) {
    if(!userIsAuditor) {
      return;
    }
    var verifyId = '#verify_';
    if(supersubsection !== null) {
      project_data.section_verification[currentYearActive][stage][section][subsection][supersubsection] = true;
    }
    else if(subsection !== null) {
      project_data.section_verification[currentYearActive][stage][section][subsection] = true;
    }
    else {
      project_data.section_verification[currentYearActive][stage][section] = true;
    }
    verifyId = verifyId + stage + '_' + section + (subsection === null ? '' : '_' + subsection ) + (supersubsection === null ? '' : '_' + supersubsection);
    $(verifyId).removeClass('btn-verify').addClass('btn-verified').text('Verified');
    window.saver.saveProject();
  }

  function selectPdf(id) {
    $('#pdf_section').val(id);
    $('#pdf_assessment_year').val(currentYearActive);
    $('#pdf_to_upload').val('');
    $('#pdf_to_upload').trigger('click');
  }

  function uploadPdf(pdfName) {
    var fd = new FormData();

    var form = $('#upload_pdf')
    var targetUrl = form.attr('action');

    $.each(form.serializeArray(), function(i, field) {
      fd.append(field.name, field.value);
    });

    var files = $('#pdf_to_upload')[0].files[0];
    fd.append('file',files);

    $.ajax({
      url: targetUrl,
      type: 'post',
      data: fd,
      headers: {
        "X-CSRF-TOKEN": fd['_token'],
      },
      contentType: false,
      processData: false,
      success: function(response){
        _successSavePdf(response);
      },
    });
  }

  function _successSavePdf(response) {
    if(response != 0){
      var originalTargetName = $('#pdf_section').val();

      var name = $('#pdf_section').val().split("_");
      var stage = name[1];
      var section = name[2];
      var subsection = name[3] != 'null' ? name[3] : false;
      var supersubsection = (typeof name[4] !== undefined) ? name[4] : false;

      if(supersubsection) {
        project_data.section_pdf[currentYearActive][stage][section][subsection][supersubsection] = response.file
      } else if (subsection) {
        project_data.section_pdf[currentYearActive][stage][section][subsection] = response.file
      } else {
        project_data.section_pdf[currentYearActive][stage][section] = response.file
      }
      var targetUrl = targetPdfPath+response.file;
      window.saver.saveProject();
      
      var id = $('#'+originalTargetName).attr('id');
      $('#'+originalTargetName).closest('li').empty().html('<a target="_blank" href="' + targetUrl + '"><button type="button" class="disabled-button btn-download-pdf" id="' + id + '">' + response.file + '</button></a>');
      ////$('body #operation_maintenance').find('#'+originalTargetName).closest('li').empty();
      //$('#'+originalTargetName).closest('li').html('&nbsp;');
    } else{
      alert('file not uploaded');
    }
    $('#pdf_to_upload').val('');
    $('#pdf_section').val('');
  }
  function setStatusSection(stage, section, subsection=null, supersubsection=null){
    var statusId = '#status_'+ stage + '_' + section + (subsection === null ? '' : '_' + subsection ) + (supersubsection === null ? '' : '_' + supersubsection);
    if(supersubsection !== null) {
      project_data.section_status[currentYearActive][stage][section][subsection][supersubsection] = $(statusId).val();
    }
    else if(subsection !== null) {
      project_data.section_status[currentYearActive][stage][section][subsection] = $(statusId).val();
    }
    else {
      project_data.section_status[currentYearActive][stage][section] = $(statusId).val();
    }
    window.saver.saveProject();
  }
  function saveCommentSection(stage, section, subsection=null, supersubsection=null){
    var commentId = 'comment_'+ stage + '_' + section + (subsection === null ? '' : '_' + subsection ) + (supersubsection === null ? '' : '_' + supersubsection);
    
    if(supersubsection !== null) {
      project_data.section_comment[currentYearActive][stage][section][subsection][supersubsection] = $("#"+commentId).val();
    }
    else if(subsection !== null) {
      project_data.section_comment[currentYearActive][stage][section][subsection] = $("#"+commentId).val();
    }
    else {
      project_data.section_comment[currentYearActive][stage][section] = $("#"+commentId).val();
    }

    //change comment button color after putting comment 
    if($("#"+commentId).val()!="")
      $("#btn_"+commentId).addClass('filled');
    else
     $("#btn_"+commentId).removeClass("filled");
    this.closePopup("popup_"+commentId);

    window.saver.saveProject();
  }

  function openPopup( id ) {
    var elem = $("#"+id);
    // Establish our default settings
    var settings = $.extend({
      anim: 'fade'
    });
    elem.show();
    elem.find('.popup-content').addClass(settings.anim+'In');
  }
  
  function closePopup ( id ) {
    var elem = $("#"+id);
    // Establish our default settings
    var settings = $.extend({
      anim: 'fade'
    });
    elem.find('.popup-content').removeClass(settings.anim+'In').addClass(settings.anim+'Out');
    
    setTimeout(function(){
        elem.hide();
        elem.find('.popup-content').removeClass(settings.anim+'Out')
      }, 500);
  }
  function txtLimit(id){
    const maxChar = 2500;
        
    var ele = document.getElementById(id);
    var charLen = ele.value.length;

    var p = document.getElementById('charCounter_'+id);
        p.innerHTML = maxChar - charLen + ' characters remaining';
        
    if (charLen > maxChar) 
    {
        ele.value = ele.value.substring(0, maxChar);
        p.innerHTML = 0 + ' characters remaining'; 
    }
  }
</script>