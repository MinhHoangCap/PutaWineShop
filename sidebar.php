<aside>
    <?php
    include('templates/part-product_sidebar.php');
    $terms = get_terms(
    array(
        'taxonomy'   => 'product_cat',
        'hide_empty' => true,
    )
);

// Check if any term exists
if ( ! empty( $terms ) && is_array( $terms ) ) {
    foreach ( $terms as $term ) { ?>
        <div class="sidebar">
            <?php
                if(category_description($term->term_id)!="")
                {
                    echo "<h3 class='category_name'>".$term->name."</h3>"; 
                    get_product_sidebar($term->slug);
                }
            ?>

        </div>            
        <?php
    }
}

?>
</aside>