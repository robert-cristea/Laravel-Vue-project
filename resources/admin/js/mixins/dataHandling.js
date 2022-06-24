export default {
  methods: {
    updateTemplateData() {
      if (!this.$props.printHeader) {
        return;
      }
      var pathIds = this.getPathIds();
      var a = pathIds.length >= 1 ? pathIds[0] : null;
      var b = pathIds.length >= 2 ? pathIds[1] : null;
      var c = pathIds.length >= 3 ? pathIds[2] : null;
      var d = pathIds.length >= 4 ? pathIds[3] : null;
      var stages = template_data['stages']
      try {
        if (pathIds.length >= 1 && stages[a] !== undefined) {
          this.stageTitle = stages[a]['title']
        }
        if (pathIds.length >= 2 && stages[a] !== undefined && stages[a]['stages'][b] !== undefined) {
          this.criteriaTitle = stages[a]['stages'][b]['title']
        }
        if (pathIds.length >= 3 && stages[a] !== undefined && stages[a]['stages'][b] !== undefined && stages[a]['stages'][b]['stages'][c] !== undefined) {
          this.subCriteriaTitle = stages[a]['stages'][b]['stages'][c]['title']
        }
        if (pathIds.length >= 4 && stages[a] !== undefined && stages[a]['stages'][b] !== undefined && stages[a]['stages'][b]['stages'][c] !== undefined && stages[a]['stages'][b]['stages'][c]['stages'][d] !== undefined) {
          this.superSubCriteriaTitle = stages[a]['stages'][b]['stages'][c]['stages'][d]['title']
        }
      } catch (e) {
        console.error("Undefined stage title for " + pathIds);
      }
    },
    storeProjectStructure(row) {
      var pathIds = this.getPathIds();
      var a = pathIds.length >= 1 ? pathIds[0] : null;
      var b = pathIds.length >= 2 ? pathIds[1] : null;
      var c = pathIds.length >= 3 ? pathIds[2] : null;
      var d = pathIds.length >= 4 ? pathIds[3] : null;
      for (var i = 0; i < pathIds.lenght; i++) {
        pathIds[i] = Number.parseInt(pathIds[i]);
      }
      if (project_data['settings'] === null) {
        project_data['settings'] = []
      }
      if (project_data['settings'][currentYearActive] === null) {
        project_data['settings'][currentYearActive] = [];
      }
      // now we get this position and store structure
      var currentProjectData = project_data['settings'][currentYearActive];
      if (pathIds.length === 4) {
        if (currentProjectData[a] == null) {
          currentProjectData[a] = []
        }
        if (currentProjectData[a][b] == null) {
          currentProjectData[a][b] = []
        }
        if (currentProjectData[a][b][c] == null) {
          currentProjectData[a][b][c] = []
        }
        var newRow = this.copyRowStructure(currentProjectData[a][b][c][d], row)
        currentProjectData[a][b][c][d] = newRow
      }
      else if (pathIds.length === 3) {
        if (currentProjectData[a] == null) {
          currentProjectData[a] = []
        }
        if (currentProjectData[a][b] == null) {
          currentProjectData[a][b] = []
        }
        if (currentProjectData[a][b][c] == null) {
          currentProjectData[a][b][c] = []
        }
        var newRow = this.copyRowStructure(currentProjectData[a][b][c], row)
        currentProjectData[a][b][c] = newRow
      }
      else if (pathIds.length === 2) {
        if (currentProjectData[a] == null) {
          currentProjectData[a] = []
        }
        if (currentProjectData[a][b] == null) {
          currentProjectData[a][b] = []
        }
        var newRow = this.copyRowStructure(currentProjectData[a][b], row)
        currentProjectData[a][b] = newRow
      }
      else if (pathIds.length === 1) {
        var newRow = this.copyRowStructure(currentProjectData[a], row)
        currentProjectData[a] = newRow
      }
      // finally we store current project data replacing current year
      project_data['settings'][currentYearActive] = currentProjectData;
    },
    copyRowStructure(oldRow, newPartialRow) {
      var newRow = this.splitRowsPerType(oldRow)
      newRow = this.overwriteSplitedRowPositionWithNewPartialRow(newRow, newPartialRow)
      var returnRows = this.joinNewRowsInOne(newRow)
      return returnRows
    },
    splitRowsPerType(oldRow) {
      var newRow = []
      for (var i = 0; i <= 7; i++) {
        newRow[i] = []
      }

      if (oldRow != null) {
        for (var i = 0; i <= oldRow.length; i++) {
          if (oldRow[i] == null) {
            continue
          }
          var row = oldRow[i]
          var type = row.type != null ? row.type : 1
          newRow[type].push(row)
        }
      }
      return newRow
    },
    overwriteSplitedRowPositionWithNewPartialRow(newRow, newPartialRow) {
      var firstNewRow = newPartialRow[0];
      if (firstNewRow != null) {
        if (firstNewRow.type == null) {
          firstNewRow.type = 1
          // fix new rows with default type 1
          for (var i = 1; i < newPartialRow.length; i++) {
            newPartialRow[i].type = 1
          }
        }
        newRow[firstNewRow.type] = newPartialRow
      }
      return newRow
    },
    joinNewRowsInOne(newRow) {
      var returnRows = []
      for (var i = 0; i < newRow.length; i++) {
        if (newRow[i] == null) {
          continue
        }
        for (var j = 0; j < newRow[i].length; j++) {
          if (newRow[i][j] == null) {
            continue
          }
          returnRows.push(newRow[i][j])
        }
      }
      return returnRows
    },
    warmData() {
      var pathIds = this.getPathIds();
      var a = pathIds.length >= 1 ? pathIds[0] : null;
      var b = pathIds.length >= 2 ? pathIds[1] : null;
      var c = pathIds.length >= 3 ? pathIds[2] : null;
      var d = pathIds.length >= 4 ? pathIds[3] : null;

      if (project_data['settings'] == null) {
        project_data['settings'] = [];
      }
      if (project_data['settings'][currentYearActive] == null) {
        project_data['settings'][currentYearActive] = [];
      }

      var settings = project_data['settings'][currentYearActive];

      if (pathIds.length === 4 && settings != null && settings[a] != null && settings[a][b] != null && settings[a][b][c] != null && settings[a][b][c][d] != null) {
        this.setDataInWarming(settings[a][b][c][d])
      }
      else if (pathIds.length === 3 && settings != null && settings[a] != null && settings[a][b] != null && settings[a][b][c] != null) {
        this.setDataInWarming(settings[a][b][c])
      }
      else if (pathIds.length === 2 && settings != null && settings[a] != null && settings[a][b] != null) {
        this.setDataInWarming(settings[a][b])
      }
      else if (pathIds.length === 1 && settings != null && settings[a] != null) {
        this.setDataInWarming(settings[a])
      }
    },
    setDataInWarming(currentObject) {
      if (currentObject == null) {
        return;
      }
      var type = this.$props.type != null ? this.$props.type : 1;
      var currentKey = 0
      for (var [key, value] of Object.entries(currentObject)) {
        if (value.type == null) {
          value.type = 1
        }
        if (value.type === type) {
          this.$set(this.rowData, currentKey, value);
          currentKey++
        }
      }
    },
    getPathIds() {
      var paths = this.$props.tableId.split(".");
      for (var i = 0; i < paths.length; i++) {
        paths[i] = paths[i].toString();
      }
      return paths;
    },
    printVerifyButton(stage, section, subsection = null, supersubsection = null) {
      var id = 'verify_' + stage + '_' + section + (subsection === null ? '' : '_' + subsection) + (supersubsection === null ? '' : '_' + supersubsection);
      var txt = '';
      if (subsection == null) {
        if (project_data.section_verification[currentYearActive][stage][section]) {
          txt = this.getVerifiedButton(id);
        } else {
          txt = '<button type="button" class="disabled-button btn-verify" onclick="verifySection(' + stage + ',' + section + ')" id="' + id + '">Verify</button>';
        }
      } else if (supersubsection == null) {
        if (project_data.section_verification[currentYearActive][stage][section][subsection]) {
          txt = this.getVerifiedButton(id);
        } else {
          txt = '<button type="button" class="disabled-button btn-verify" onclick="verifySection(' + stage + ',' + section + ',' + subsection + ')" id="' + id + '">Verify</button>';
        }
      } else {
        if (project_data.section_verification[currentYearActive][stage][section][subsection][supersubsection]) {
          txt = this.getVerifiedButton(id);
        }
        else {
          txt = '<button type="button" class="disabled-button btn-verify" onclick="verifySection(' + stage + ',' + section + ',' + subsection + ',' + supersubsection + ')" id="' + id + '">Verify</button>';
        }
      }
      return txt;
    },
    getVerifiedButton(id) {
      return '<button type="button" class="disabled-button btn-verified" id="' + id + '">Verified</button>';
    },
    printDownloadPdf(stage, section, subsection = null, supersubsection = null) {
      try {
        var id = 'pdf_' + stage + '_' + section + '_' + subsection + '_' + (supersubsection === null ? '' : supersubsection);
        var txt = '';
        if (subsection === null) {
          if (project_data.section_pdf[currentYearActive][stage][section]) {
            var file = project_data.section_pdf[currentYearActive][stage][section];
            txt = '<a target="_blank" href="' + targetPdfPath + project_data.section_pdf[currentYearActive][stage][section] + '"><button type="button" class="disabled-button btn-download-pdf" id="' + id + '">' + file + '</button></a>';
          }
          else {
            txt = this.getUploadButton(id);
          }
        }
        else if (supersubsection === null) {
          if (project_data.section_pdf[currentYearActive][stage][section][subsection]) {
            var file = project_data.section_pdf[currentYearActive][stage][section][subsection];
            txt = '<a target="_blank" href="' + targetPdfPath + project_data.section_pdf[currentYearActive][stage][section][subsection] + '"><button type="button" class="disabled-button btn-download-pdf" id="' + id + '">' + file + '</button></a>';
          }
          else {
            txt = this.getUploadButton(id);
          }
        }
        else {
          if (project_data.section_pdf[currentYearActive][stage][section][subsection][supersubsection]) {
            var file = project_data.section_pdf[currentYearActive][stage][section][subsection][supersubsection];
            txt = '<a target="_blank" href="' + targetPdfPath + project_data.section_pdf[currentYearActive][stage][section][subsection][supersubsection] + '"><button type="button" class="disabled-button btn-download-pdf" id="' + id + '">' + file + '</button></a>';
          }
          else {
            txt = this.getUploadButton(id);
          }
        }
        return txt;
      }
      catch (e) {
        console.log("Error generating download pdf: " + e);
        console.log("Stage that raised error: " + stage + " " + section + " " + subsection + " " + supersubsection);
      }
    },
    getUploadButton(id) {
      if (userIsConcessionaire) {
        return '<button type="button" class="disabled-button btn-upload-pdf" onclick="this.value=null;selectPdf(\'' + id + '\')" onchange="uploadPdf()" id="' + id + '">Upload Pdf</button>';
      } else {
        return '<button type="button" class="disabled-button btn-upload-pdf" id="' + id + '">Upload Pdf</button>';
      }
    },
    getStatusOpt(stage, section, subsection = null, supersubsection = null) {
      var id = 'status_' + stage + '_' + section + (subsection === null ? '' : '_' + subsection) + (supersubsection === null ? '' : '_' + supersubsection);

      var val = "";
     
      if (subsection === null) {
        if (project_data.section_status[currentYearActive][stage][section]) {
           val = project_data.section_status[currentYearActive][stage][section];
        }
      }
      else if (supersubsection === null) {
        if (project_data.section_status[currentYearActive][stage][section][subsection]) {
           val = project_data.section_status[currentYearActive][stage][section][subsection];
        }
      }
      else {
        if (project_data.section_status[currentYearActive][stage][section][subsection][supersubsection]) {
           val = project_data.section_status[currentYearActive][stage][section][subsection][supersubsection];
        }
      }
     
     
      return '<select class="status-dropdown" id="' + id + '" onChange="setStatusSection(' + stage + ',' + section + ',' + subsection + ',' + supersubsection + ')">'
              +'<option value="" '+(val=="" ? "selected":"")+' >Status</option>'
              +'<option value="YES" '+(val=="YES" ? "selected":"")+' >YES</option>'
              +'<option value="NO" '+(val=="NO" ? "selected":"")+' >NO</option>'
              +'<option value="NA" '+(val=="NA" ? "selected":"")+' >NA</option>'
              +'</select>';
    },
    getCommentBox(stage, section, subsection = null, supersubsection = null) {
      var id = 'comment_' + stage + '_' + section + (subsection === null ? '' : '_' + subsection) + (supersubsection === null ? '' : '_' + supersubsection);

      var valStatus =0;
      var val = "";
      if (subsection === null) {
        if (project_data.section_comment[currentYearActive][stage][section]) {
           val = project_data.section_comment[currentYearActive][stage][section];
           valStatus = 1;
        }
      }
      else if (supersubsection === null) {
        if (project_data.section_comment[currentYearActive][stage][section][subsection]) {
           val = project_data.section_comment[currentYearActive][stage][section][subsection];
           valStatus = 1;
        }
      }
      else {
        if (project_data.section_comment[currentYearActive][stage][section][subsection][supersubsection]) {
           val = project_data.section_comment[currentYearActive][stage][section][subsection][supersubsection];
           valStatus = 1;
        }
      }

   
      return '<button type="button" class="disabled-button btn-comment '+(valStatus==1 ? "filled":"")+'" onclick="openPopup(\'popup_' + id + '\')"  id="btn_' + id + '">Comment</button>'
      +'<div id="popup_' + id + '" class="popup comment-box"><div class="popup-overlay"></div><div class="popup-content">'
      +'<textarea id="' + id + '" onKeyPress="txtLimit(\'' + id + '\')">'+val+'</textarea><br />'
      +'<em>* Maximum 2,500 Character</em><p class="count" id="charCounter_' + id + '"></p>'
      +'<div class="btn-container"><button class="close-popup" onClick="closePopup(\'popup_' + id + '\')">Cancel</button>&nbsp;&nbsp;&nbsp;&nbsp;<button class="save-btn" onClick="saveCommentSection(' + stage + ',' + section + ',' + subsection + ',' + supersubsection + ')">Save</button></div>'
      +'</div></div>';
    }

  },


}