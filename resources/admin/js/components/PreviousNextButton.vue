<template>
    <div class="w-100">
        <div class="float-right">
            <button type="button" class="btn btn-primary" v-on:click="goBack()">Previous</button>
            <button type="button" class="btn btn-primary" v-on:click="saveAndGoHome()" v-if="authUser.role != 'auditor'">Finish</button>
            <button type="button" class="btn btn-primary" v-on:click="goForward()">Next</button>
        </div>
    </div>
</template>

<script>
  import SaveProjectMixin from '../mixins/saveProject.js'
  export default {
    mixins: [SaveProjectMixin],
    props: {
      'navigationContainer': {
        type: String,
        default: 'construction_navigation'
      },
      'specialForwardEffectTabs': {
        type: String,
        default: ''
      }
    },
    data: function() {
      return {
        authUser: authUser,
      }
    },
    methods: {
      goBack() {
        this.saveProject();
        this.navigateBack();
      },
      saveAndGoHome() {
        this.saveProject().then(response => {
          window.location.reload();
        });
      },
      navigateBack() {
        var criteria = $('#'+this.$props.navigationContainer+' > .nav-tabs > .nav-item > .active')
        // find related tab
        var relatedTab = criteria.attr('href')
        var subCriteria = $(relatedTab).find('.nav-tabs > .nav-item > .active')
          .parent().prev('li').find('a')
        if(subCriteria.length) {
          subCriteria.trigger('click');
        }
        else {
          criteria = criteria.parent().prev('li').find('a')
          criteria.trigger('click')
          relatedTab = criteria.attr('href')
          subCriteria = $(relatedTab).find('.nav-tabs > .nav-item').last('li')
          if(subCriteria.length > 0) {
            subCriteria.last('li').find('a').tab('show')
          }
        }
      },
      goForward() {
        this.saveProject()
        this.navigateForward()
      },
      navigateForward() {
        if(this.specialForwardEffectTabs) {
          console.log('specialNavigateForward', this.specialForwardEffectTabs)
          this.specialNavigateForward()
          return;
        }
        var criteria = $('#'+this.$props.navigationContainer+' > .nav-tabs > .nav-item > .active')
        // find related tab
        var relatedTab = criteria.attr('href')
        var subCriteria = $(relatedTab).find('.nav-tabs > .nav-item > .active')
          .parent().next('li').find('a')
        if(subCriteria.length) {
          subCriteria.trigger('click');
          this.scrollTo(subCriteria, 120);
        } else {
          // go next, but in parent
          criteria = criteria.parent().next('li').find('a')
          criteria.trigger('click')
          this.scrollTo(criteria, 120);
          // and find and select first son
          relatedTab = criteria.attr('href')
          subCriteria = $(relatedTab).find('.nav-tabs > .nav-item').first('li')
          if(subCriteria.length > 0) {
            subCriteria.first('li').find('a').tab('show')
          }
        }
      },
      specialNavigateForward() {
        var tabsToTrigger = this.specialForwardEffectTabs.split(",")
        for(var i=0; i<tabsToTrigger.length; i++) {
          $('#'+tabsToTrigger[i]).find('a').trigger('click');
          this.scrollTo($('#'+tabsToTrigger[i]), 100);
        }
      },
      scrollTo(element, offset) {
        $([document.documentElement, document.body]).animate({
          scrollTop: element.offset().top - offset
        }, 100);
      }
    }
  }
</script>
