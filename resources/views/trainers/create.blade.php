<x-layout>

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-xl-10">

            <div class="card auth-card border-0 text-light">

                <div class="card-body p-5">


                    <div class="text-center mb-5">

                        <h1 class="fw-bold">
                            Create Trainer
                        </h1>

                        <p class="text-secondary">
                            Add a new trainer to the sports staff
                        </p>

                    </div>


                    {{-- Errors --}}
                    @if($errors->any())

                        <div class="alert alert-danger">

                            <ul class="mb-0">

                                @foreach($errors->all() as $error)

                                    <li>{{ $error }}</li>

                                @endforeach

                            </ul>

                        </div>

                    @endif



<form action="{{ route('trainers.store') }}"
      method="POST"
      enctype="multipart/form-data">

@csrf



{{-- Personal Information --}}
<h4 class="mb-4">
    Personal Information
</h4>


<div class="row g-4 mb-5">


<div class="col-md-4">

<label class="form-label">
    First Name *
</label>

<input type="text"
       name="firstname"
       value="{{ old('firstname') }}"
       class="form-control">

</div>



<div class="col-md-4">

<label class="form-label">
    Last Name *
</label>

<input type="text"
       name="lastname"
       value="{{ old('lastname') }}"
       class="form-control">

</div>



<div class="col-md-4">

<label class="form-label">
    Father's Name
</label>

<input type="text"
       name="fathername"
       value="{{ old('fathername') }}"
       class="form-control">

</div>



<div class="col-md-6">

<label class="form-label">
    National ID (SSN) *
</label>

<input type="text"
       name="SSN"
       maxlength="11"
       value="{{ old('SSN') }}"
       class="form-control">

</div>



<div class="col-md-3">

<label class="form-label">
    Gender *
</label>

<select name="gender"
        class="form-select">


<option value="">
Select Gender
</option>


<option value="Male">
Male
</option>


<option value="Female">
Female
</option>


</select>

</div>



<div class="col-md-3">

<label class="form-label">
    Profile Image
</label>

<input type="file"
       name="image"
       class="form-control">


</div>


</div>





{{-- Contact --}}
<h4 class="mb-4">
    Contact Information
</h4>



<div class="row g-4 mb-5">


<div class="col-md-4">

<label class="form-label">
Phone *
</label>


<input type="text"
       name="phone"
       value="{{ old('phone') }}"
       class="form-control">


</div>



<div class="col-md-4">

<label class="form-label">
Email
</label>


<input type="email"
       name="email"
       value="{{ old('email') }}"
       class="form-control">


</div>



<div class="col-12">

<label class="form-label">
Address
</label>


<textarea name="address"
          rows="3"
          class="form-control">{{ old('address') }}</textarea>


</div>


</div>





{{-- Professional --}}
<h4 class="mb-4">
    Professional Details
</h4>



<div class="row g-4 mb-5">


<div class="col-md-4">

<label class="form-label">
Specialization *
</label>


<select name="sports_type_id"
        class="form-select">


<option value="">
Select Specialty
</option>


@foreach($sportsTypes as $type)

<option value="{{ $type->id }}">

{{ $type->type }}

</option>

@endforeach


</select>


</div>





<div class="col-md-4">


<label class="form-label">
Certification
</label>


<select name="certification"
        class="form-select">


<option value="level_1">
Level 1 (Basic)
</option>


<option value="level_2">
Level 2 (Advanced)
</option>


<option value="level_3">
Level 3 (Professional)
</option>


<option value="level_4">
Level 4 (Expert)
</option>


</select>


</div>




<div class="col-md-4">


<label class="form-label">
Employment Status *
</label>


<select name="trainer_status_id"
        class="form-select">


<option value="">
Select Status
</option>


@foreach($trainerStatuses as $status)

<option value="{{ $status->id }}">

{{ $status->status }}

</option>

@endforeach


</select>


</div>




<div class="col-md-4">

<label class="form-label">
Years of Experience *
</label>


<input type="number"
       name="years_of_experience"
       min="2"
       max="50"
       value="{{ old('years_of_experience') }}"
       class="form-control">


</div>




<div class="col-md-4">

<label class="form-label">
Birth Date *
</label>


<input type="date"
       name="birthdate"
       class="form-control">


</div>




<div class="col-md-4">

<label class="form-label">
Hiring Date *
</label>


<input type="date"
       name="hiring_date"
       class="form-control">


</div>




<div class="col-12">

<label class="form-label">
Birth Place
</label>


<input type="text"
       name="birthplace"
       value="{{ old('birthplace') }}"
       class="form-control">


</div>


</div>





<div class="d-flex justify-content-end gap-3">


<a href="{{ route('trainers.index') }}"
   class="btn btn-secondary">

Cancel

</a>



<button type="submit"
        class="btn btn-success px-5">

Create Trainer

</button>


</div>



</form>


                </div>

            </div>

        </div>

    </div>

</div>

</x-layout>
