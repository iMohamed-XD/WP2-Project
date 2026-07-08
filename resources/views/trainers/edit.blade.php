<x-layout>

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-xl-10">

            <div class="card auth-card border-0 text-light">

                <div class="card-body p-5">


                    <div class="text-center mb-5">

                        <h1 class="fw-bold">
                            Edit Trainer
                        </h1>

                        <p class="text-secondary">
                            Update trainer information
                        </p>

                    </div>



                    @if($errors->any())

                        <div class="alert alert-danger">

                            <ul class="mb-0">

                                @foreach($errors->all() as $error)

                                    <li>{{ $error }}</li>

                                @endforeach

                            </ul>

                        </div>

                    @endif




<form action="{{ route('trainers.update',$trainer->id) }}"
      method="POST"
      enctype="multipart/form-data">

@csrf
@method('PUT')





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
       value="{{ old('firstname',$trainer->firstname) }}"
       class="form-control">


</div>




<div class="col-md-4">

<label class="form-label">
Last Name *
</label>


<input type="text"
       name="lastname"
       value="{{ old('lastname',$trainer->lastname) }}"
       class="form-control">


</div>




<div class="col-md-4">

<label class="form-label">
Father's Name
</label>


<input type="text"
       name="fathername"
       value="{{ old('fathername',$trainer->fathername) }}"
       class="form-control">


</div>





<div class="col-md-6">

<label class="form-label">
National ID (SSN) *
</label>


<input type="text"
       name="SSN"
       maxlength="11"
       value="{{ old('SSN',$trainer->SSN) }}"
       class="form-control">


</div>





<div class="col-md-3">

<label class="form-label">
Gender *
</label>


<select name="gender"
        class="form-select">


<option value="Male"
{{ old('gender',$trainer->gender)=='Male'?'selected':'' }}>
Male
</option>


<option value="Female"
{{ old('gender',$trainer->gender)=='Female'?'selected':'' }}>
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


@if($trainer->image)

<img src="{{ asset('storage/'.$trainer->image) }}"
     class="img-thumbnail mt-3"
     style="width:120px;height:120px;object-fit:cover;">

@endif


</div>


</div>






{{-- Contact Information --}}

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
       value="{{ old('phone',$trainer->phone) }}"
       class="form-control">


</div>





<div class="col-md-4">

<label class="form-label">
Email
</label>


<input type="email"
       name="email"
       value="{{ old('email',$trainer->email) }}"
       class="form-control">


</div>

<div class="col-12">


<label class="form-label">
Address
</label>


<textarea name="address"
          rows="3"
          class="form-control">{{ old('address',$trainer->address) }}</textarea>


</div>


</div>







{{-- Professional Details --}}

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

<option value="{{ $type->id }}"
{{ old('sports_type_id',$trainer->sports_type_id)==$type->id?'selected':'' }}>

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


<option value="level_1"
{{ old('certification',$trainer->certification)=='level_1'?'selected':'' }}>
Level 1 (Basic)
</option>


<option value="level_2"
{{ old('certification',$trainer->certification)=='level_2'?'selected':'' }}>
Level 2 (Advanced)
</option>


<option value="level_3"
{{ old('certification',$trainer->certification)=='level_3'?'selected':'' }}>
Level 3 (Professional)
</option>


<option value="level_4"
{{ old('certification',$trainer->certification)=='level_4'?'selected':'' }}>
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


<option value="{{ $status->id }}"
{{ old('trainer_status_id',$trainer->trainer_status_id)==$status->id?'selected':'' }}>

{{ $status->status }}

</option>


@endforeach


</select>


</div>






<div class="col-md-4">


<label class="form-label">
Years Of Experience *
</label>


<input type="number"
       name="years_of_experience"
       min="2"
       max="50"
       value="{{ old('years_of_experience',$trainer->years_of_experience) }}"
       class="form-control">


</div>






<div class="col-md-4">


<label class="form-label">
Birth Date *
</label>


<input type="date"
       name="birthdate"
       value="{{ old('birthdate',$trainer->birthdate?->format('Y-m-d')) }}"
       class="form-control">


</div>






<div class="col-md-4">


<label class="form-label">
Hiring Date *
</label>


<input type="date"
       name="hiring_date"
       value="{{ old('hiring_date',$trainer->hiring_date?->format('Y-m-d')) }}"
       class="form-control">


</div>






<div class="col-12">


<label class="form-label">
Birth Place
</label>


<input type="text"
       name="birthplace"
       value="{{ old('birthplace',$trainer->birthplace) }}"
       class="form-control">


</div>



</div>






<div class="d-flex justify-content-end gap-3">


<a href="{{ route('trainers.show',$trainer->id) }}"
   class="btn btn-secondary">

Cancel

</a>



<button type="submit"
        class="btn btn-primary px-5">

Save Changes

</button>



</div>



</form>



                </div>

            </div>

        </div>

    </div>

</div>

</x-layout>
