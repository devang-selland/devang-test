/* Add Block JS Here */
                        (function($){
                            /**
                             * initializeBlock
                             *
                             * Adds custom JavaScript to the block HTML.
                             *
                             * @since   1.0.0
                             *
                             * @param   object $block The block jQuery element.
                             * @param   object attributes The block attributes (only available when editing).
                             * @return  void
                             */
                            var initializeBlock = function( ) {
                                // Add your code here
                            }
                            // Initialize each block on page load (front end).
                            $(document).ready(function(){
                                initializeBlock(); 
                            });
                        
                            // Initialize dynamic block preview (editor).
                            if( window.acf ) {
                                window.acf.addAction( "render_block_preview/type=add_block_slug_here", initializeBlock );        
                            }
                        })(jQuery);