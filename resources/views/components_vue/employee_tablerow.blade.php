
<script type="text/x-template" id="vue_emp_row">

<ul class="results_header_table">
  <!-- <th>@{{thisId}}</th> -->
  <li @click="setFocus('title')">
    <p v-show="!isFocus('title')">@{{firstName}}</p>
    <input v-show="isFocus('title')" type="text" name="first_name" :value="firstName">
  </li>

  <li @click="setFocus('title')">
    <p v-show="!isFocus('title')">@{{lastName}}</p>
    <input v-show="isFocus('title')" type="text" name="last_name" :value="lastName">
  </li>

  <li @click="setFocus('empCompany')">
    <p v-show="!isFocus('title')">@{{empCompany}}</p>
    <select  v-show="isFocus('title')" class="company_select" name="company">
      <option value="">Compay</option>
    </select>
  </li>
  <li @click="setFocus('empEtitleempEmailtitlemail')">
    <p v-show="!isFocus('empEtitleempEmailtitlemail')">@{{empEmail}}</p>
    <input  v-show="isFocus('empEtitleempEmailtitlemail')" type="email" name="email" :value="empEmail">
  </li>
  <li @click="setFocus('title')">
    <p v-show="!isFocus('title')">@{{empPhone}}</p>
    <input  v-show="isFocus('title')" type="phone" name="phone" :value="empPhone">
  </li>
  <li>
    <button  @click="saveMe()" data-id="" type="button" class="btn_edit_empl btn btn-light">Edit</button>
    <button data-id="" type="button" class="btn_delete_empl btn btn-danger">Delete</button>
    <span @click="setFocus('')">back</span>
  </li>

</ul>


</script>


{{--
<input type="text" name="first_name" v:bind="@{{firstName}}">
<input type="text" name="last_name" value="{{$employee-> last_name}}">
<select employee-id="{{$employee-> id}}" class="company_select" name="company">
</select>
<input employee-id="{{$employee-> id}}" type="email" name="email"value="{{$employee-> email}}">
<input employee-id="{{$employee-> id}}" type="phone" name="phone"value="{{$employee-> phone}}"> --}}

<script type="text/javascript">
  Vue.component('employee', {
    template: '#vue_emp_row',
    data: function(){
      return {

        // myCiao : this.ciao,
        // counterItems : this.count
        // thisEmp: this.employees
        // relatedEmployees: this.employees
        thisId : this.id,
        firstName: this.first_name,
        lastName: this.last_name,
        empCompany: this.company,
        empEmail: this.email,
        empPhone: this.phone,
        editField: '',

      };
    },

    props:{

      // ciao: String,
      // count: Number,
      // employees: Object,
      id: Number,
      first_name: String,
      last_name: String,
      company: String,
      email: String,
      phone: String
      // employee: Object
    },

    methods: {

      isFocus(field){

        return this.editField == field;
         console.log(this.editField);
      },
      setFocus(field){
          this.editField = field;
      },

      saveMe() {
        var post = {

        };

      },

    }

  });
 </script>
