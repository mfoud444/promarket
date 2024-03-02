<div class="filter">
    <form action="search" method="post">
    <input type="text" class="search-box1" type="search" name="keywords" id="search" placeholder="<?php echo $t('Search', 1); ?>" />



        <div class="filter-div" id="filter-div">
   
        <!-- <div class="filter-options input-group">
        <label for="brand-filter">Brand:</label>
        <select name="brand-filter" class="form-control" id="brand-filter">
            <option value="all">All Brands</option>
            <option value="brand1">Brand 1</option>
            <option value="brand2">Brand 2</option>
          
        </select>
    </div> -->
    
    <div class="filter-options input-group">
        <label for="price-filter"><?php $t('Price')?> :</label>
        <select name="price-filter" class="form-control" id="price-filter">
            <option value="all">All Price</option>
            <option value="price">PRICE (LOW to HIGH)</option>
            <option value="price-desc">PRICE (HIGH to LOW)</option>
        
        </select>
    </div>

</div>


        <button type="submit" class="btn btn-primary btn-action-table" ><?php $t('Search')?></button>

        
    </form>
    <div class="flex" id="filter-button">
        <div><?php $t('Filter')?> </div>
        <i class='bx bx-filter box-icon'></i>
    </div>
</div>



<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function () {
    // Get references to the filter button and filter div
    var filterButton = document.getElementById("filter-button");
    var filterDiv = document.getElementById("filter-div");

    // Add a click event listener to the filter button
    filterButton.addEventListener("click", function () {
        // Toggle the display of the filter div
        if (filterDiv.style.display === "none" || filterDiv.style.display === "") {
            filterDiv.style.display = "block";
        } else {
            filterDiv.style.display = "none";
        }
    });
});

</script>
