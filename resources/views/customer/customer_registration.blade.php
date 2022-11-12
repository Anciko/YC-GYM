@extends('customer.layouts.app_home')

@section('content')
<form id="regForm">

    <!-- body measurements-->
    <div class="cutomer-registeration-form tab customer-registeration-card">
        <p class="customer-registeration-form-header">
            Body Measurements
        </p>


        <div class="customer-registeration-height-container">
          <p class="customer-registeration-label">Height</p>
          <select class="customer-registeration-input" name="feet">
              <option style="color: black;" value="">Feet</option>
              <option style="color: black;" value="4">4</option>
              <option style="color: black;" value="5">5</option>
              <option style="color: black;" value="6">6</option>
          </select>
          <select class="customer-registeration-input" name="inches">
              <option style="color: black;" value="">Inches</option>
              <option style="color: black;" value="0">0</option>
              <option style="color: black;" value="1">1</option>
              <option style="color: black;" value="2">2</option>
              <option style="color: black;" value="3">3</option>
              <option style="color: black;" value="4">4</option>
              <option style="color: black;" value="5">5</option>
              <option style="color: black;" value="6">6</option>
              <option style="color: black;" value="7">7</option>
              <option style="color: black;" value="8">8</option>
              <option style="color: black;" value="9">9</option>
              <option style="color: black;" value="10">10</option>
              <option style="color: black;" value="11">11</option>
          </select>
        </div>
        <input  type="number" required class="customer-registeration-input" placeholder="Age" name="age">
        <select class="customer-registeration-input" name="gender" onchange="checkFemale(this)">
            <option style="color: black;" value="">Gender</option>
            <option  style="color: black;" value="male">Male</option>
            <option  style="color: black;" value="female">Female</option>
        </select>
        <div class="customer-registeration-with-description">
            <input  type="number" required class="customer-registeration-input" placeholder="Neck" name="neck">
            <iconify-icon icon="ant-design:exclamation-circle-outlined" class="description-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Place the measuring tape around the neck at the height where the collar would normally rest – just below your Adam's apple."></iconify-icon>
        </div>
        <div class="customer-registeration-with-description">
            <input  type="number" required class="customer-registeration-input" placeholder="Waist" name="waist">
            <iconify-icon icon="ant-design:exclamation-circle-outlined" class="description-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="place a non-stretch tape measure around your midsection above your hip bones, making sure the tape measure is horizontal around your waist. Keep the tape measure snug, but make sure to avoid compressing the skin ( 14 ). Breathe out, then measure the circumference of your waist"></iconify-icon>
        </div>
        <div class="customer-registeration-with-description" id="parent-hip">
            <!-- <input  type="number" required class="customer-registeration-input" placeholder="Hip" name="hip"> -->
            <iconify-icon  icon="ant-design:exclamation-circle-outlined" class="description-icon hip-tooltip" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Stand with your feet directly beneath your hips and wrap the tape around the widest part of your hips and buttocks."></iconify-icon>
        </div>
        <div class="customer-registeration-with-description">
            <input  type="number" required class="customer-registeration-input" placeholder="Shoulders" name="shoulders">
            <iconify-icon icon="ant-design:exclamation-circle-outlined" class="description-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Description on measuring Shoulders size"></iconify-icon>
        </div>


        <div class="customer-form-btn-container">
          <button class="customer-registeration-prev-btn customer-primary-btn" type="button" id="prevBtn" onclick="nextPrev(-1)">
            <iconify-icon icon="akar-icons:arrow-left" class="customer-prev-icon"></iconify-icon>
            <p>Previous</p>
          </button>
          <button class="customer-registeration-next-btn customer-primary-btn" type="button" id="nextBtn" onclick="nextPrev(1,'bodyMeasurements')">
            <p>Next</p>
            <iconify-icon icon="akar-icons:arrow-right" class="customer-next-icon"></iconify-icon>
          </button>
        </div>

    </div>

    <!--physical limitations-->
    <div class="cutomer-registeration-form tab customer-registeration-card">
        <p class="customer-registeration-form-header">
           Do you have any physical limitations?
        </p>

        <div class="checkbox">
          <label class="checkbox-wrapper">
            <input type="checkbox" name="physicalLimitations" class="checkbox-input" value="none"/>
            <span class="checkbox-tile">
              <span class="checkbox-icon">
                <iconify-icon icon="radix-icons:value-none" class="checkbox-icon-icon"></iconify-icon>
              </span>
              <span class="checkbox-label">none</span>
            </span>
          </label>
        </div>
        <div class="checkbox">
          <label class="checkbox-wrapper">
            <input type="checkbox" name="physicalLimitations" class="checkbox-input" value="back pain"/>
            <span class="checkbox-tile">
              <span class="checkbox-icon">
                <iconify-icon icon="healthicons:back-pain" class="checkbox-icon-icon"></iconify-icon>
              </span>
              <span class="checkbox-label">Back Pain</span>
            </span>
          </label>
        </div>
        <div class="checkbox">
          <label class="checkbox-wrapper">
            <input type="checkbox" name="physicalLimitations" class="checkbox-input" value="knee pain"/>
            <span class="checkbox-tile">
              <span class="checkbox-icon">
                <iconify-icon icon="game-icons:knee-bandage" class="checkbox-icon-icon"></iconify-icon>
              </span>
              <span class="checkbox-label">Knee pain</span>
            </span>
          </label>
        </div>
        <div class="checkbox">
          <label class="checkbox-wrapper">
            <input type="checkbox" name="physicalLimitations" class="checkbox-input" value="limited mobility"/>
            <span class="checkbox-tile">
              <span class="checkbox-icon">
                <iconify-icon icon="el:wheelchair" class="checkbox-icon-icon"></iconify-icon>
              </span>
              <span class="checkbox-label">Limited mobility</span>
            </span>
          </label>
        </div>
        <div class="checkbox">
          <label class="checkbox-wrapper">
            <input type="checkbox" name="physicalLimitations" class="checkbox-input" value="other"/>
            <span class="checkbox-tile">
              <span class="checkbox-icon">
                <iconify-icon icon="ph:dots-three-outline-thin" class="checkbox-icon-icon"></iconify-icon>
              </span>
              <span class="checkbox-label">Other</span>
            </span>
          </label>
        </div>


        <div class="customer-form-btn-container">
          <button class="customer-registeration-prev-btn customer-primary-btn" type="button" id="prevBtn" onclick="nextPrev(-1)">
            <iconify-icon icon="akar-icons:arrow-left" class="customer-prev-icon"></iconify-icon>
            <p>Previous</p>
          </button>
          <button class="customer-registeration-next-btn customer-primary-btn" type="button" id="nextBtn" onclick="nextPrev(1,'physicalLimitations')">
            <p>Next</p>
            <iconify-icon icon="akar-icons:arrow-right" class="customer-next-icon"></iconify-icon>
          </button>
        </div>

    </div>

    <!--which activities do you prefer-->
    <div class="cutomer-registeration-form tab customer-registeration-card">
      <p class="customer-registeration-form-header">
         Which activities do you prefer?
      </p>

      <div class="checkbox">
        <label class="checkbox-wrapper">
          <input type="checkbox" name = "preferedActivities" class="checkbox-input physical-limit-checkbox" value="working out at home"  onclick="checkedOnClick(this,'preferedActivities')"/>
          <span class="checkbox-tile">
            <span class="checkbox-icon">
              <iconify-icon icon="fa-solid:home" class="checkbox-icon-icon"></iconify-icon>
            </span>
            <span class="checkbox-label">Working out at home<br>
              <span class="checkbox-label-small">with minimal equipment</span>
            </span>

          </span>
        </label>
      </div>
      <div class="checkbox">
        <label class="checkbox-wrapper">
          <input type="checkbox" name = "preferedActivities" class="checkbox-input physical-limit-checkbox" value="working out at a gym" onclick="checkedOnClick(this,'preferedActivities')"/>
          <span class="checkbox-tile">
            <span class="checkbox-icon">
              <iconify-icon icon="game-icons:gym-bag" class="checkbox-icon-icon"></iconify-icon>
            </span>
            <span class="checkbox-label">Working out at a gym<br>
              <span class="checkbox-label-small">with weights and machines</span>
            </span>
          </span>
        </label>
      </div>
      <div class="checkbox">
        <label class="checkbox-wrapper">
          <input type="checkbox" name = "preferedActivities" class="checkbox-input physical-limit-checkbox" value="running" onclick="checkedOnClick(this,'preferedActivities')"/>
          <span class="checkbox-tile">
            <span class="checkbox-icon">
              <iconify-icon icon="fa6-solid:person-running" class="checkbox-icon-icon"></iconify-icon>
            </span>
            <span class="checkbox-label">Running<br>
              <span class="checkbox-label-small">Running with guidance</span>
            </span>
          </span>
        </label>
      </div>
      <div class="checkbox">
        <label class="checkbox-wrapper">
          <input type="checkbox" name = "preferedActivities" class="checkbox-input physical-limit-checkbox" value="walking" onclick="checkedOnClick(this,'preferedActivities')"/>
          <span class="checkbox-tile">
            <span class="checkbox-icon">
              <iconify-icon icon="fa6-solid:person-walking" class="checkbox-icon-icon"></iconify-icon>
            </span>
            <span class="checkbox-label">Walking<br>
              <span class="checkbox-label-small">Walking with guidance</span>
            </span>
          </span>
        </label>
      </div>


      <div class="customer-form-btn-container">
        <button class="customer-registeration-prev-btn customer-primary-btn" type="button" id="prevBtn" onclick="nextPrev(-1)">
          <iconify-icon icon="akar-icons:arrow-left" class="customer-prev-icon"></iconify-icon>
          <p>Previous</p>
        </button>
        <button class="customer-registeration-next-btn customer-primary-btn" type="button" id="nextBtn" onclick="nextPrev(1,'preferedActivities')">
          <p>Next</p>
          <iconify-icon icon="akar-icons:arrow-right" class="customer-next-icon"></iconify-icon>
        </button>
      </div>

    </div>

    <!--your body type-->
    <div class="cutomer-registeration-form tab customer-registeration-card">
      <p class="customer-registeration-form-header">
         Your body type<br>
         <span>Which body type do you have?</span>
      </p>

      <div class="checkbox-flex-container">


        <div class="checkbox checkbox-vertical">
          <label class="checkbox-wrapper">
            <input type="checkbox" name = "bodyType" class="checkbox-input" value="Ectomorph"  onclick="checkedOnClick(this,'bodyType')"/>
            <span class="checkbox-tile">
              <span class="checkbox-icon">
                <div class="body-type-img">
                    <img src="{{asset('image/registeration/ectomorph.png')}}">
                </div>
              </span>
              <span class="checkbox-label">Ectomorph<br>

              </span>

            </span>
          </label>
        </div>
        <div class="checkbox checkbox-vertical">
          <label class="checkbox-wrapper">
            <input type="checkbox" name = "bodyType" class="checkbox-input" value="Mesomorph" onclick="checkedOnClick(this,'bodyType')"/>
            <span class="checkbox-tile">
              <span class="checkbox-icon">
                <div class="body-type-img">
                    <img src="{{asset('image/registeration/mesomorph.png')}}">
                </div>
              </span>
              <span class="checkbox-label">Mesomorph<br>

              </span>
            </span>
          </label>
        </div>
        <div class="checkbox checkbox-vertical">
          <label class="checkbox-wrapper">
            <input type="checkbox" name = "bodyType" class="checkbox-input" value="Endomorph" onclick="checkedOnClick(this,'bodyType')"/>
            <span class="checkbox-tile">
              <span class="checkbox-icon">
                <div class="body-type-img">
                    <img src="{{asset('image/registeration/endomorph.png')}}">
                </div>
              </span>
              <span class="checkbox-label">Endomorph<br>

              </span>
            </span>
          </label>
        </div>
      </div>



      <div class="customer-form-btn-container">
        <button class="customer-registeration-prev-btn customer-primary-btn" type="button" id="prevBtn" onclick="nextPrev(-1)">
          <iconify-icon icon="akar-icons:arrow-left" class="customer-prev-icon"></iconify-icon>
          <p>Previous</p>
        </button>
        <button class="customer-registeration-next-btn customer-primary-btn" type="button" id="nextBtn" onclick="nextPrev(1,'bodyType')">
          <p>Next</p>
          <iconify-icon icon="akar-icons:arrow-right" class="customer-next-icon"></iconify-icon>
        </button>
      </div>

    </div>

    <!--main goal-->
    <div class="cutomer-registeration-form tab customer-registeration-card">
      <p class="customer-registeration-form-header">
         What's your main goal?
      </p>

      <div class="checkbox">
        <label class="checkbox-wrapper">
          <input type="checkbox" name = "mainGoal" class="checkbox-input" value="lose weight"  onclick="checkedOnClick(this,'mainGoal')"/>
          <span class="checkbox-tile">
            <span class="checkbox-icon">
              <iconify-icon icon="game-icons:fat" class="checkbox-icon-icon"></iconify-icon>
            </span>
            <span class="checkbox-label">Lose Weight<br>
              <span class="checkbox-label-small">Drop extra pounds with ease</span>
            </span>

          </span>
        </label>
      </div>
      <div class="checkbox">
        <label class="checkbox-wrapper">
          <input type="checkbox" name = "mainGoal" class="checkbox-input" value="build muscles" onclick="checkedOnClick(this,'mainGoal')"/>
          <span class="checkbox-tile">
            <span class="checkbox-icon">
              <iconify-icon icon="icon-park-outline:muscle" class="checkbox-icon-icon"></iconify-icon>
            </span>
            <span class="checkbox-label">Build Muscles<br>
              <span class="checkbox-label-small">Get lean and strong</span>
            </span>
          </span>
        </label>
      </div>
      <div class="checkbox">
        <label class="checkbox-wrapper">
          <input type="checkbox" name = "mainGoal" class="checkbox-input" value="keep fit" onclick="checkedOnClick(this,'mainGoal')"/>
          <span class="checkbox-tile">
            <span class="checkbox-icon">
              <iconify-icon icon="game-icons:muscle-up" class="checkbox-icon-icon"></iconify-icon>
            </span>
            <span class="checkbox-label">Keep fit<br>
              <span class="checkbox-label-small">Stay in shape</span>
            </span>
          </span>
        </label>
      </div>


      <div class="customer-form-btn-container">
        <button class="customer-registeration-prev-btn customer-primary-btn" type="button" id="prevBtn" onclick="nextPrev(-1)">
          <iconify-icon icon="akar-icons:arrow-left" class="customer-prev-icon"></iconify-icon>
          <p>Previous</p>
        </button>
        <button class="customer-registeration-next-btn customer-primary-btn" type="button" id="nextBtn" onclick="nextPrev(1,'mainGoal')">
          <p>Next</p>
          <iconify-icon icon="akar-icons:arrow-right" class="customer-next-icon"></iconify-icon>
        </button>
      </div>

    </div>

    <!--typical day-->
    <div class="cutomer-registeration-form tab customer-registeration-card">
      <p class="customer-registeration-form-header">
         What's your typical day look like?<br>
         <span>You need an individual approach based on your habits to reach your goal</span>
      </p>

      <div class="checkbox checkbox-big">
        <label class="checkbox-wrapper">
          <input type="checkbox" name = "typicalDay" class="checkbox-input" value="at the office"  onclick="checkedOnClick(this,'typicalDay')"/>
          <span class="checkbox-tile">
            <span class="checkbox-icon">
              <div class="typical-day-img">
                <img src="{{asset('image/registeration/at_the_office.png')}}">
              </div>
            </span>
            <span class="checkbox-label">At the office<br>
              <span class="checkbox-label-small">Little to no physical activity</span>
            </span>

          </span>
        </label>
      </div>
      <div class="checkbox checkbox-big">
        <label class="checkbox-wrapper">
          <input type="checkbox" name = "typicalDay" class="checkbox-input" value="walking daily" onclick="checkedOnClick(this,'typicalDay')"/>
          <span class="checkbox-tile">
            <span class="checkbox-icon">
              <div class="typical-day-img">
                <img src="{{asset('image/registeration/walking.png')}}">
              </div>
            </span>
            <span class="checkbox-label">Walking Daily<br>
              <span class="checkbox-label-small">Moderate amount of physical activity</span>
            </span>
          </span>
        </label>
      </div>
      <div class="checkbox checkbox-big">
        <label class="checkbox-wrapper">
          <input type="checkbox" name = "typicalDay" class="checkbox-input" value="working physically" onclick="checkedOnClick(this,'typicalDay')"/>
          <span class="checkbox-tile">
            <span class="checkbox-icon">
              <div class="typical-day-img">
                <img src="{{asset('image/registeration/working_physically.png')}}">
              </div>
            </span>
            <span class="checkbox-label">Working physically<br>
              <span class="checkbox-label-small">Good amount of physical activity</span>
            </span>
          </span>
        </label>
      </div>
      <div class="checkbox checkbox-big">
        <label class="checkbox-wrapper">
          <input type="checkbox" name = "typicalDay" class="checkbox-input" value="mostly at home" onclick="checkedOnClick(this,'typicalDay')"/>
          <span class="checkbox-tile">
            <span class="checkbox-icon">
              <div class="typical-day-img">
                <img src="{{asset('image/registeration/physicallt_active.png')}}">
              </div>
            </span>
            <span class="checkbox-label">Mostly at home<br>
              <span class="checkbox-label-small">No physical ativity at all</span>
            </span>
          </span>
        </label>
      </div>


      <div class="customer-form-btn-container">
        <button class="customer-registeration-prev-btn customer-primary-btn" type="button" id="prevBtn" onclick="nextPrev(-1)">
          <iconify-icon icon="akar-icons:arrow-left" class="customer-prev-icon"></iconify-icon>
          <p>Previous</p>
        </button>
        <button class="customer-registeration-next-btn customer-primary-btn" type="button" id="nextBtn" onclick="nextPrev(1,'typicalDay')">
          <p>Next</p>
          <iconify-icon icon="akar-icons:arrow-right" class="customer-next-icon"></iconify-icon>
        </button>
      </div>

    </div>

    <!--diet type-->
    <div class="cutomer-registeration-form tab customer-registeration-card">
      <p class="customer-registeration-form-header">
         Choose your diet type

      </p>

      <div class="checkbox checkbox-small">
        <label class="checkbox-wrapper">
          <input type="checkbox" name = "diet" class="checkbox-input" value="traditional" onclick="checkedOnClick(this,'diet')"/>
          <span class="checkbox-tile">
            <span class="checkbox-icon">
              <div class="diet-icon">
                <img src="{{asset('image/registeration/traditional.png')}}">
              </div>
            </span>
            <span class="checkbox-label">Traditional<br>

            </span>

          </span>
        </label>
      </div>
      <div class="checkbox checkbox-small">
        <label class="checkbox-wrapper">
          <input type="checkbox" name = "diet" class="checkbox-input" value="vagetarian" onclick="checkedOnClick(this,'diet')"/>
          <span class="checkbox-tile">
            <span class="checkbox-icon">
              <div class="diet-icon">
                <img src="{{asset('image/registeration/vagetarion.png')}}">
              </div>
            </span>
            <span class="checkbox-label">Vagetarian<br>

            </span>

          </span>
        </label>
      </div>
      <div class="checkbox checkbox-small">
        <label class="checkbox-wrapper">
          <input type="checkbox" name = "diet" class="checkbox-input" value="keto" onclick="checkedOnClick(this,'diet')"/>
          <span class="checkbox-tile">
            <span class="checkbox-icon">
              <div class="diet-icon">
                <img src="{{asset('image/registeration/keto.png')}}">
              </div>
            </span>
            <span class="checkbox-label">Keto<br>

            </span>

          </span>
        </label>
      </div>
      <div class="checkbox checkbox-small">
        <label class="checkbox-wrapper">
          <input type="checkbox" name = "diet" class="checkbox-input" value="pescatarian" onclick="checkedOnClick(this,'diet')"/>
          <span class="checkbox-tile">
            <span class="checkbox-icon">
              <div class="diet-icon">
                <img src="{{asset('image/registeration/pescatarian.png')}}">
              </div>
            </span>
            <span class="checkbox-label">Pescatarian<br>

            </span>

          </span>
        </label>
      </div>
      <div class="checkbox checkbox-small">
        <label class="checkbox-wrapper">
          <input type="checkbox" name = "diet" class="checkbox-input" value="vegan" onclick="checkedOnClick(this,'diet')"/>
          <span class="checkbox-tile">
            <span class="checkbox-icon">
              <div class="diet-icon">
                <img src="{{asset('image/registeration/vegan.png')}}">
              </div>
            </span>
            <span class="checkbox-label">Vegan<br>

            </span>

          </span>
        </label>
      </div>
      <div class="checkbox checkbox-small">
        <label class="checkbox-wrapper">
          <input type="checkbox" name = "diet" class="checkbox-input" value="keto vegan" onclick="checkedOnClick(this,'diet')"/>
          <span class="checkbox-tile">
            <span class="checkbox-icon">
              <div class="diet-icon">
                <img src="{{asset('image/registeration/keto_vegan.png')}}">
              </div>
            </span>
            <span class="checkbox-label">Keto vegan<br>

            </span>

          </span>
        </label>
      </div>
      <div class="checkbox checkbox-small">
        <label class="checkbox-wrapper">
          <input type="checkbox" name = "diet" class="checkbox-input" value="lactose free" onclick="checkedOnClick(this,'diet')"/>
          <span class="checkbox-tile">
            <span class="checkbox-icon">
              <div class="diet-icon">
                <img src="{{asset('image/registeration/lactose_free.png')}}">
              </div>
            </span>
            <span class="checkbox-label">Lactose free<br>

            </span>

          </span>
        </label>
      </div>


      <div class="customer-form-btn-container">
        <button class="customer-registeration-prev-btn customer-primary-btn" type="button" id="prevBtn" onclick="nextPrev(-1)">
          <iconify-icon icon="akar-icons:arrow-left" class="customer-prev-icon"></iconify-icon>
          <p>Previous</p>
        </button>
        <button class="customer-registeration-next-btn customer-primary-btn" type="button" id="nextBtn" onclick="nextPrev(1,'diet')">
          <p>Next</p>
          <iconify-icon icon="akar-icons:arrow-right" class="customer-next-icon"></iconify-icon>
        </button>
      </div>

    </div>

    <!--average night-->
    <div class="cutomer-registeration-form tab customer-registeration-card">
      <p class="customer-registeration-form-header">
         What's your average night like?<br>
         <span>Sleep is vary important not only for well-being but also for keeping in shape</span>
      </p>

      <div class="average-night-img">
        <img src="{{asset('image/registeration/sleep.png')}}">
      </div>

      <div class="checkbox-grid-container">
        <div class="checkbox">
          <label class="checkbox-wrapper">
            <input type="checkbox" name = "sleep" class="checkbox-input" value="minimal" onclick="checkedOnClick(this,'sleep')"/>
            <span class="checkbox-tile">

              <span class="checkbox-label">Minimal<br>
                <span class="checkbox-label-small">less than 5 hours</span>
              </span>

            </span>
          </label>
        </div>
        <div class="checkbox">
          <label class="checkbox-wrapper">
            <input type="checkbox" name = "sleep" class="checkbox-input" value="average" onclick="checkedOnClick(this,'sleep')"/>
            <span class="checkbox-tile">

              <span class="checkbox-label">Average<br>
                <span class="checkbox-label-small">5 - 6 hours</span>
              </span>

            </span>
          </label>
        </div>
        <div class="checkbox">
          <label class="checkbox-wrapper">
            <input type="checkbox" name = "sleep" class="checkbox-input" value="good" onclick="checkedOnClick(this,'sleep')"/>
            <span class="checkbox-tile">

              <span class="checkbox-label">Good<br>
                <span class="checkbox-label-small">7 - 8 hours</span>
              </span>

            </span>
          </label>
        </div>
        <div class="checkbox">
          <label class="checkbox-wrapper">
            <input type="checkbox" name = "sleep" class="checkbox-input" value="sleep hero" onclick="checkedOnClick(this,'sleep')"/>
            <span class="checkbox-tile">

              <span class="checkbox-label">Sleep hero<br>
                <span class="checkbox-label-small">More than 8 hours</span>
              </span>

            </span>
          </label>
        </div>
      </div>


      <div class="customer-form-btn-container">
        <button class="customer-registeration-prev-btn customer-primary-btn" type="button" id="prevBtn" onclick="nextPrev(-1)">
          <iconify-icon icon="akar-icons:arrow-left" class="customer-prev-icon"></iconify-icon>
          <p>Previous</p>
        </button>
        <button class="customer-registeration-next-btn customer-primary-btn" type="button" id="nextBtn" onclick="nextPrev(1,'sleep')">
          <p>Next</p>
          <iconify-icon icon="akar-icons:arrow-right" class="customer-next-icon"></iconify-icon>
        </button>
      </div>

    </div>

    <!--energy level-->
    <div class="cutomer-registeration-form tab customer-registeration-card">
      <p class="customer-registeration-form-header">
         How's your energy level during the day?<br>
      </p>

      <div class="checkbox checkbox-big">
        <label class="checkbox-wrapper">
          <input type="checkbox" name = "energyLevel" class="checkbox-input" value="even throughout the day"  onclick="checkedOnClick(this,'energyLevel')"/>
          <span class="checkbox-tile">
            <span class="checkbox-icon">
              <div class="typical-day-img">
                <img src="{{asset('image/registeration/even.png')}}">
              </div>
            </span>
            <span class="checkbox-label">Even throughout the day<br>

            </span>

          </span>
        </label>
      </div>
      <div class="checkbox checkbox-big">
        <label class="checkbox-wrapper">
          <input type="checkbox" name = "energyLevel" class="checkbox-input" value="a dip in energy around lunch time" onclick="checkedOnClick(this,'energyLevel')"/>
          <span class="checkbox-tile">
            <span class="checkbox-icon">
              <div class="typical-day-img">
                <img src="{{asset('image/registeration/dip_lunch.png')}}">
              </div>
            </span>
            <span class="checkbox-label">I feel a dip in energy around lunch time<br>

            </span>
          </span>
        </label>
      </div>
      <div class="checkbox checkbox-big">
        <label class="checkbox-wrapper">
          <input type="checkbox" name = "energyLevel" class="checkbox-input" value="a nap after meals" onclick="checkedOnClick(this,'energyLevel')"/>
          <span class="checkbox-tile">
            <span class="checkbox-icon">
              <div class="typical-day-img">
                <img src="{{asset('image/registeration/nap_aftermeals.png')}}">
              </div>
            </span>
            <span class="checkbox-label">I need a nap after meals<br>

            </span>
          </span>
        </label>
      </div>


      <div class="customer-form-btn-container">
        <button class="customer-registeration-prev-btn customer-primary-btn" type="button" id="prevBtn" onclick="nextPrev(-1)">
          <iconify-icon icon="akar-icons:arrow-left" class="customer-prev-icon"></iconify-icon>
          <p>Previous</p>
        </button>
        <button class="customer-registeration-next-btn customer-primary-btn" type="button" id="nextBtn" onclick="nextPrev(1,'energyLevel')">
          <p>Next</p>
          <iconify-icon icon="akar-icons:arrow-right" class="customer-next-icon"></iconify-icon>
        </button>
      </div>

    </div>

    <!--ideal weight-->
    <div class="cutomer-registeration-form tab customer-registeration-card">
      <p class="customer-registeration-form-header">
        When was the last time you were at your ideal weight?

      </p>

      <div class="average-night-img">
        <img src="{{asset('image/registeration/ideal_weight.png')}}">
      </div>

      <div class="checkbox-grid-container">
        <div class="checkbox">
          <label class="checkbox-wrapper">
            <input type="checkbox" name = "idealWeight" class="checkbox-input" value="less than a year ago" onclick="checkedOnClick(this,'idealWeight')"/>
            <span class="checkbox-tile">

              <span class="checkbox-label">Less than a year ago<br>

              </span>

            </span>
          </label>
        </div>
        <div class="checkbox">
          <label class="checkbox-wrapper">
            <input type="checkbox" name = "idealWeight" class="checkbox-input" value="1 to 2 years ago" onclick="checkedOnClick(this,'idealWeight')"/>
            <span class="checkbox-tile">

              <span class="checkbox-label">1 to 2 years ago<br>

              </span>

            </span>
          </label>
        </div>
        <div class="checkbox">
          <label class="checkbox-wrapper">
            <input type="checkbox" name = "idealWeight" class="checkbox-input" value="more than 3 years ago" onclick="checkedOnClick(this,'idealWeight')"/>
            <span class="checkbox-tile">

              <span class="checkbox-label">More than 3 years ago<br>

              </span>

            </span>
          </label>
        </div>
        <div class="checkbox">
          <label class="checkbox-wrapper">
            <input type="checkbox" name = "idealWeight" class="checkbox-input" value="never" onclick="checkedOnClick(this,'idealWeight')"/>
            <span class="checkbox-tile">

              <span class="checkbox-label">Never<br>

              </span>

            </span>
          </label>
        </div>
      </div>


      <div class="customer-form-btn-container">
        <button class="customer-registeration-prev-btn customer-primary-btn" type="button" id="prevBtn" onclick="nextPrev(-1)">
          <iconify-icon icon="akar-icons:arrow-left" class="customer-prev-icon"></iconify-icon>
          <p>Previous</p>
        </button>
        <button class="customer-registeration-next-btn customer-primary-btn" type="button" id="nextBtn" onclick="nextPrev(1,'idealWeight')">
          <p>Next</p>
          <iconify-icon icon="akar-icons:arrow-right" class="customer-next-icon"></iconify-icon>
        </button>
      </div>

    </div>

    <!--area of the body that needs the most attention-->
    <div class="cutomer-registeration-form tab customer-registeration-card">
      <p class="customer-registeration-form-header">
        Which areas of your body need the most attention?

      </p>

      <div class="bodyarea-container">
        <div class="body-area-img"></div>
        <div class="checkbox floating-checkbox">
          <label class="checkbox-wrapper">
            <input type="checkbox" name = "bodyArea" class="checkbox-input" value="back" />
            <span class="checkbox-tile">

              <span class="checkbox-label">Back<br>

              </span>

            </span>
          </label>
        </div>
        <div class="checkbox floating-checkbox">
          <label class="checkbox-wrapper">
            <input type="checkbox" name = "bodyArea" class="checkbox-input" value="chest" />
            <span class="checkbox-tile">

              <span class="checkbox-label">Chest<br>

              </span>

            </span>
          </label>
        </div>
        <div class="checkbox floating-checkbox">
          <label class="checkbox-wrapper">
            <input type="checkbox" name = "bodyArea" class="checkbox-input" value="arms" />
            <span class="checkbox-tile">

              <span class="checkbox-label">Arms<br>

              </span>

            </span>
          </label>
        </div>
        <div class="checkbox floating-checkbox">
          <label class="checkbox-wrapper">
            <input type="checkbox" name = "bodyArea" class="checkbox-input" value="belly" />
            <span class="checkbox-tile">

              <span class="checkbox-label">Belly<br>

              </span>

            </span>
          </label>
        </div>
        <div class="checkbox floating-checkbox">
          <label class="checkbox-wrapper">
            <input type="checkbox" name = "bodyArea" class="checkbox-input" value="butt" />
            <span class="checkbox-tile">

              <span class="checkbox-label">Butt<br>

              </span>

            </span>
          </label>
        </div>
        <div class="checkbox floating-checkbox">
          <label class="checkbox-wrapper">
            <input type="checkbox" name = "bodyArea" class="checkbox-input" value="legs" />
            <span class="checkbox-tile">

              <span class="checkbox-label">Legs<br>

              </span>

            </span>
          </label>
        </div>
      </div>






      <div class="customer-form-btn-container">
        <button class="customer-registeration-prev-btn customer-primary-btn" type="button" id="prevBtn" onclick="nextPrev(-1)">
          <iconify-icon icon="akar-icons:arrow-left" class="customer-prev-icon"></iconify-icon>
          <p>Previous</p>
        </button>
        <button class="customer-registeration-next-btn customer-primary-btn" type="button" id="nextBtn" onclick="nextPrev(1,'bodyArea')">
          <p>Next</p>
          <iconify-icon icon="akar-icons:arrow-right" class="customer-next-icon"></iconify-icon>
        </button>
      </div>

    </div>
    <!--how physically active are you-->
    <div class="cutomer-registeration-form tab customer-registeration-card">
      <p class="customer-registeration-form-header">
         How physically active are you?<br>
         <span>Your physical activity plays a major role if you want to lose weight or keep in shape while spending most of your time in the office</span>
      </p>

      <div class="average-night-img">
        <img src="{{asset('image/registeration/physical_activity.png')}}">
      </div>

      <div class="checkbox-grid-container">
        <div class="checkbox">
          <label class="checkbox-wrapper">
            <input type="checkbox" name = "physicalActivity" class="checkbox-input" value="not much" onclick="checkedOnClick(this,'physicalActivity')"/>
            <span class="checkbox-tile">

              <span class="checkbox-label">Not much<br>

              </span>

            </span>
          </label>
        </div>
        <div class="checkbox">
          <label class="checkbox-wrapper">
            <input type="checkbox" name = "physicalActivity" class="checkbox-input" value="1 - 2 times a week" onclick="checkedOnClick(this,'physicalActivity')"/>
            <span class="checkbox-tile">

              <span class="checkbox-label">1 - 2 times a week<br>

              </span>

            </span>
          </label>
        </div>
        <div class="checkbox">
          <label class="checkbox-wrapper">
            <input type="checkbox" name = "physicalActivity" class="checkbox-input" value="3 - 5 times a week" onclick="checkedOnClick(this,'physicalActivity')"/>
            <span class="checkbox-tile">

              <span class="checkbox-label">3 - 5 times a week<br>

              </span>

            </span>
          </label>
        </div>
        <div class="checkbox">
          <label class="checkbox-wrapper">
            <input type="checkbox" name = "physicalActivity" class="checkbox-input" value="5 - 7 times a week" onclick="checkedOnClick(this,'physicalActivity')"/>
            <span class="checkbox-tile">

              <span class="checkbox-label">5 - 7 times a week<br>

              </span>

            </span>
          </label>
        </div>
      </div>


      <div class="customer-form-btn-container">
        <button class="customer-registeration-prev-btn customer-primary-btn" type="button" id="prevBtn" onclick="nextPrev(-1)">
          <iconify-icon icon="akar-icons:arrow-left" class="customer-prev-icon"></iconify-icon>
          <p>Previous</p>
        </button>
        <button class="customer-registeration-next-btn customer-primary-btn" type="button" id="nextBtn" onclick="nextPrev(1,'physicalActivity')">
          <p>Next</p>
          <iconify-icon icon="akar-icons:arrow-right" class="customer-next-icon"></iconify-icon>
        </button>
      </div>

    </div>

    <!--bad habits-->
    <div class="cutomer-registeration-form tab customer-registeration-card">
      <p class="customer-registeration-form-header">
         Bad habits<br>
         <span>Which activities are yout guilty pleasure?</span>
      </p>

      <div class="checkbox">
        <label class="checkbox-wrapper">
          <input type="checkbox" name = "badHabits" class="checkbox-input" value="i don't rest enough"  />
          <span class="checkbox-tile">
            <span class="checkbox-icon">
              <div class="checkbox-icon-medium">
                <img src="{{asset('image/registeration/enough_rest.png')}}">
              </div>
            </span>
            <span class="checkbox-label">I don't rest enough<br>

            </span>

          </span>
        </label>
      </div>
      <div class="checkbox">
        <label class="checkbox-wrapper">
          <input type="checkbox" name = "badHabits" class="checkbox-input" value="sweet tooth"  />
          <span class="checkbox-tile">
            <span class="checkbox-icon">
              <div class="checkbox-icon-medium">
                <img src="{{asset('image/registeration/sweet_tooth.png')}}">
              </div>
            </span>
            <span class="checkbox-label">I have a sweet tooth<br>

            </span>

          </span>
        </label>
      </div>
      <div class="checkbox">
        <label class="checkbox-wrapper">
          <input type="checkbox" name = "badHabits" class="checkbox-input" value="too much soda"  />
          <span class="checkbox-tile">
            <span class="checkbox-icon">
              <div class="checkbox-icon-medium">
                <img src="{{asset('image/registeration/soda.png')}}">
              </div>
            </span>
            <span class="checkbox-label">I consume too much soda<br>

            </span>

          </span>
        </label>
      </div>
      <div class="checkbox">
        <label class="checkbox-wrapper">
          <input type="checkbox" name = "badHabits" class="checkbox-input" value="a lot of salty foods"  />
          <span class="checkbox-tile">
            <span class="checkbox-icon">
              <div class="checkbox-icon-medium">
                <img src="{{asset('image/registeration/salty_food.png')}}">
              </div>
            </span>
            <span class="checkbox-label">I consume a lot of salty foods<br>

            </span>

          </span>
        </label>
      </div>
      <div class="checkbox">
        <label class="checkbox-wrapper">
          <input type="checkbox" name = "badHabits" class="checkbox-input" value="late night snacks"  />
          <span class="checkbox-tile">
            <span class="checkbox-icon">
              <div class="checkbox-icon-medium">
                <img src="{{asset('image/registeration/snacks.png')}}">
              </div>
            </span>
            <span class="checkbox-label">Late night snacks<br>

            </span>

          </span>
        </label>
      </div>



      <div class="customer-form-btn-container">
        <button class="customer-registeration-prev-btn customer-primary-btn" type="button" id="prevBtn" onclick="nextPrev(-1)">
          <iconify-icon icon="akar-icons:arrow-left" class="customer-prev-icon"></iconify-icon>
          <p>Previous</p>
        </button>
        <button class="customer-registeration-next-btn customer-primary-btn" type="button" id="nextBtn" onclick="nextPrev(1,'badHabits')">
          <p>Next</p>
          <iconify-icon icon="akar-icons:arrow-right" class="customer-next-icon"></iconify-icon>
        </button>
      </div>

    </div>

    <!--daily water intake-->
    <div class="cutomer-registeration-form tab customer-registeration-card">
      <p class="customer-registeration-form-header">
         What's your daily water intake?

      </p>

      <div class="checkbox">
        <label class="checkbox-wrapper">
          <input type="checkbox" name = "waterIntake" class="checkbox-input" value="only coffee or tea"  onclick="checkedOnClick(this,'waterIntake')"/>
          <span class="checkbox-tile">
            <span class="checkbox-icon">
              <div class="checkbox-icon-medium">
                <img src="{{asset('image/registeration/coffee.png')}}">
              </div>
            </span>
            <span class="checkbox-label">I only have coffee or tea<br>

            </span>

          </span>
        </label>
      </div>
      <div class="checkbox">
        <label class="checkbox-wrapper">
          <input type="checkbox" name = "waterIntake" class="checkbox-input" value="about 2 glasses"  onclick="checkedOnClick(this,'waterIntake')"/>
          <span class="checkbox-tile">
            <span class="checkbox-icon">
              <div class="checkbox-icon-medium">
                <img src="{{asset('image/registeration/2glasses.png')}}">
              </div>
            </span>
            <span class="checkbox-label">About 2 glasses<br>

            </span>

          </span>
        </label>
      </div>
      <div class="checkbox">
        <label class="checkbox-wrapper">
          <input type="checkbox" name = "waterIntake" class="checkbox-input" value="2 to 6 glasses"  onclick="checkedOnClick(this,'waterIntake')"/>
          <span class="checkbox-tile">
            <span class="checkbox-icon">
              <div class="checkbox-icon-medium">
                <img src="{{asset('image/registeration/6glasses.png')}}">
              </div>
            </span>
            <span class="checkbox-label">2 to 6 glasses<br>

            </span>

          </span>
        </label>
      </div>
      <div class="checkbox">
        <label class="checkbox-wrapper">
          <input type="checkbox" name = "waterIntake" class="checkbox-input" value="more than 6 glasses"  onclick="checkedOnClick(this,'waterIntake')"/>
          <span class="checkbox-tile">
            <span class="checkbox-icon">
              <div class="checkbox-icon-medium">
                <img src="{{asset('image/registeration/water_bottle.png')}}">
              </div>
            </span>
            <span class="checkbox-label">More than 6 glasses<br>

            </span>

          </span>
        </label>
      </div>


      <div class="customer-form-btn-container">
        <button class="customer-registeration-prev-btn customer-primary-btn" type="button" id="prevBtn" onclick="nextPrev(-1)">
          <iconify-icon icon="akar-icons:arrow-left" class="customer-prev-icon"></iconify-icon>
          <p>Previous</p>
        </button>
        <button class="customer-registeration-next-btn customer-primary-btn" type="button" id="nextBtn" onclick="nextPrev(1,'waterIntake')">
          <p>Next</p>
          <iconify-icon icon="akar-icons:arrow-right" class="customer-next-icon"></iconify-icon>
        </button>
      </div>

    </div>

    <!--weight -->
    <div class="cutomer-registeration-form tab customer-registeration-card">
        <p class="customer-registeration-form-header">
            Weight
         </p>
         <input  type="number" required class="customer-registeration-input" placeholder="Weight" name="weight">
         <input  type="number" required class="customer-registeration-input" placeholder="Ideal Weight" name="idealWeightInput">

         <p class="weight-difference-text"></p>

         <div class="customer-form-btn-container">
            <button class="customer-registeration-prev-btn customer-primary-btn" type="button" id="prevBtn" onclick="nextPrev(-1)">
              <iconify-icon icon="akar-icons:arrow-left" class="customer-prev-icon"></iconify-icon>
              <p>Previous</p>
            </button>
            <button class="customer-registeration-next-btn customer-primary-btn" type="button" id="nextBtn" onclick="nextPrev(1,'weight')">
              <p>Next</p>
              <iconify-icon icon="akar-icons:arrow-right" class="customer-next-icon"></iconify-icon>
            </button>
        </div>

    </div>

    <!--proficiency-->
    <div class="cutomer-registeration-form tab customer-registeration-card">
      <p class="customer-registeration-form-header">
         How proficient are you?<br>

      </p>

      <div class="checkbox-flex-container">


        <div class="checkbox checkbox-vertical">
          <label class="checkbox-wrapper">
            <input type="checkbox" name = "proficiency" class="checkbox-input" value="beginner"  onclick="checkedOnClick(this,'proficiency')"/>
            <span class="checkbox-tile">
              <span class="checkbox-icon">
                <div class="body-type-img">
                    <img src="{{asset('image/registeration/beginner.png')}}">
                </div>
              </span>
              <span class="checkbox-label">Beginner<br>

              </span>

            </span>
          </label>
        </div>
        <div class="checkbox checkbox-vertical">
          <label class="checkbox-wrapper">
            <input type="checkbox" name = "proficiency" class="checkbox-input" value="advanced" onclick="checkedOnClick(this,'proficiency')"/>
            <span class="checkbox-tile">
              <span class="checkbox-icon">
                <div class="body-type-img">
                    <img src="{{asset('image/registeration/advanced.png')}}">
                </div>
              </span>
              <span class="checkbox-label">Advanced<br>

              </span>
            </span>
          </label>
        </div>
        <div class="checkbox checkbox-vertical">
          <label class="checkbox-wrapper">
            <input type="checkbox" name = "proficiency" class="checkbox-input" value="professional" onclick="checkedOnClick(this,'proficiency')"/>
            <span class="checkbox-tile">
              <span class="checkbox-icon">
                <div class="body-type-img">
                    <img src="{{asset('image/registeration/professional.png')}}">
                </div>
              </span>
              <span class="checkbox-label">Professional<br>

              </span>
            </span>
          </label>
        </div>
      </div>



      <div class="customer-form-btn-container">
        <button class="customer-registeration-prev-btn customer-primary-btn" type="button" id="prevBtn" onclick="nextPrev(-1)">
          <iconify-icon icon="akar-icons:arrow-left" class="customer-prev-icon"></iconify-icon>
          <p>Previous</p>
        </button>
        <button type="button" class="customer-registeration-next-btn customer-primary-btn" id="nextBtn" onclick="nextPrev(1,'proficiency')">
          <p>Next</p>
          <iconify-icon icon="akar-icons:arrow-right" class="customer-next-icon"></iconify-icon>
        </button>

      </div>

    </div>
</form>

@endsection
@push('scripts')
<script>

</script>
@endpush

