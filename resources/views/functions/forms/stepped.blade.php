<div class="container mt-5" id="stepped-form">
  <form onsubmit="return validateForm()">
    <!-- Step 1 -->
    <div id="step1">
      <h4>Step 1: Personal Info</h4>
      <div class="form-group">
        <label>Full Name</label>
        <input type="text" class="form-control" id="fullName" required>
      </div>
      <div class="form-group">
        <label>Email</label>
        <input type="email" class="form-control" id="email" required>
      </div>
      <button type="button" class="btn btn-primary" onclick="nextStep()">Next</button>
    </div>

    <!-- Step 2 -->
    <div id="step2" style="display:none;">
      <h4>Step 2: Account Details</h4>
      <div class="form-group">
        <label>Password</label>
        <input type="password" class="form-control" id="password" required>
      </div>
      <button type="button" class="btn btn-secondary" onclick="prevStep()">Back</button>
      <button type="button" class="btn btn-primary" onclick="nextStep()">Next</button>
    </div>

    <!-- Step 3 -->
    <div id="step3" style="display:none;">
      <h4>Step 3: Confirm</h4>
      <p><strong>Name:</strong> <span id="confirmName"></span></p>
      <p><strong>Email:</strong> <span id="confirmEmail"></span></p>
      <button type="button" class="btn btn-secondary" onclick="prevStep()">Back</button>
      <button type="submit" class="btn btn-success">Submit</button>
    </div>
  </form>
</div>

<script>
  let currentStep = 1;
  function showStep(step) {
    document.getElementById('step1').style.display = step === 1 ? 'block' : 'none';
    document.getElementById('step2').style.display = step === 2 ? 'block' : 'none';
    document.getElementById('step3').style.display = step === 3 ? 'block' : 'none';
  }

  function nextStep() {
    if (currentStep === 1) {
      // Example validation
      const name = document.getElementById('fullName').value;
      const email = document.getElementById('email').value;
      if (!name || !email) {
        alert('Please fill out all fields');
        return;
      }
    }
    if (currentStep === 2) {
      document.getElementById('confirmName').innerText = document.getElementById('fullName').value;
      document.getElementById('confirmEmail').innerText = document.getElementById('email').value;
    }
    currentStep++;
    showStep(currentStep);
  }

  function prevStep() {
    currentStep--;
    showStep(currentStep);
  }

  function validateForm() {
    alert('Form submitted!');
    return false; // prevent actual submission for demo
  }

  // Initialize
  showStep(currentStep);
</script>
