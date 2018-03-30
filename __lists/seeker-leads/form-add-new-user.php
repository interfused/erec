<div id="wrapper-add_user">
      <form id="add_new_user_form" enctype="multipart/form-data">
        <p class="required">* required</p>
        <div class="form-group">
          <label>First Name *</label>
          <input name="first_name" type="text" required />
        </div>

        <div class="form-group">
          <label>Last Name *</label>
          <input name="last_name" type="text" required />
        </div>

        <div class="form-group">
          <label>Email *</label>
          <input name="email" type="text" required />
        </div>

        <div class="form-group">
          <label>Phone</label>
          <input name="phone" type="text" />
        </div>

        <div class="form-group">
          <label>Resume</label>
          <input name="resume" id="resume" type="file" />
        </div>

        <div class="form-group">
          <label>Industry</label>
          <select name="industry" >
            <option val=""></option>
              <option value="Security">Security</option>
<option value="Investigations">Investigations</option>
<option value="Surveillance">Surveillance</option>
<option value="Risk Management">Risk Management</option>
<option value="Information Technology">Information Technology</option>
<option value="Loss Prevention">Loss Prevention</option>

          </select>

          </div>

          <div class="form-group">
            <label>Contact Source</label>
            <input name="contact_source" type="text" />
          </div>

          <div class="form-group">
            <label>Zip Code</label>
            <input name="zip" type="text" />
          </div>
          <div class="form-group">
            <label>Desired Salary Range</label>
          <select name="SALARY_REQ" class="" id="mce-SALARY_REQ">
  <option value=""></option>
  <option value="30K-35K">30K-35K</option>
<option value="35K-40K">35K-40K</option>
<option value="40K-45K">40K-45K</option>
<option value="45K-50K">45K-50K</option>
<option value="50K-55K">50K-55K</option>
<option value="55K-60K">55K-60K</option>
<option value="60K-65K">60K-65K</option>
<option value="65K-70K">65K-70K</option>
<option value="70K-75K">70K-75K</option>
<option value="75K-80K">75K-80K</option>
<option value="80K-85K">80K-85K</option>
<option value="85K-90K">85K-90K</option>
<option value="90K-95K">90K-95K</option>
<option value="95K-100K">95K-100K</option>
<option value="100K-125K">100K-125K</option>
<option value="125K-150K">125K-150K</option>
<option value="150K+">150K+</option>

  </select>
</div>

        

        <button id="submit_new_user" disabled ><i class="fa fa-plus"></i> Add User</button>

      </form>
    </div>