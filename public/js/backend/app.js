//$(".chosen-select").chosen({width: "50%"});
new Vue({
    el: '#users',
    data:{
        loading: true
    },
    ready: function(){
        this.fetchUsers();

    },
    methods: {
        fetchUsers: function(){

            this.$http.get('manager/user', function (data) {

                this.$set('users', data)
                this.loading = false;

            }).error(function (data, status, request) {

            })
        }
    }
});