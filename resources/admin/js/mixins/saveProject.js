export default {
  methods: {
    saveProject () {
      needDataUpdate = true;
      return axios.post('/admin/projects/' + project_data.id, {
        data: project_data,
        _method: 'patch'
      })
      // .then(function (response) {
      //   if(response.data.status == 'OK') {
      //     window.location.reload();
      //   }
      // }).catch(function (error) {
      //   console.error(error);
      // });
    },
  }
}