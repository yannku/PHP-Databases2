


<div class="row justify-content-center title">
                <div class="col-6">
                  <p><?=$course['c_name'];?></p>
                </div>
                <div class="col-sm-4">
                    <img class="corimg" src="Images\3d modelling2.jpg" alt="">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-8">
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ut efficitur leo. Donec quis orci vitae nibh imperdiet viverra. Etiam eget vestibulum ex. Nullam pretium tempus elit.
                    Mauris fermentum, ex quis condimentum rutrum, nisi sem tincidunt diam, vel placerat urna mauris facilisis velit. Sed eu arcu varius, vehicula justo nec, blandit neque. Sed facilisis ligula in arcu dapibus lacinia.</p>
                </div>
            </div>
            <div class="row justify-content-center">
                <table class="col-6 table ">
                    <thead>
                     <tr>
                        <td scope="col">Course Code</td>
                        <td scope="col"><?=$course['c_code'];?></td>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Duration</td>
                        <td><?=$course['c_duration'];?> years</td>
                      </tr>
                      <tr>
                        <td>MQF</td>
                        <td>Level <?=$course['c_mqf'];?></td>
                      </tr>
                     </tbody>
                </table>
             </div>
