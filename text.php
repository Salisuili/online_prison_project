<?php /*
					$i = 1;
						$qry = $conn->query("SELECT *,concat(lastname,', ', firstname, coalesce(concat(' ', middlename), '')) as `name` from `inmate_list` order by `name` asc ");
						while($row = $qry->fetch_assoc()):*/
					?>
						<tr>
							<td class="text-center"><?php //echo $i++; ?>1</td>
							<td></td>
							<td class=""></td>
							<td class=""></td>
							<td class="text-center">
                            <?php// if(isset($row['date_to']) && !empty($row['date_to']) && strtotime($row['date_to']) <= strtotime(date('Y-m-d'))): ?>
                                    <span class="badge badge-primary bg-gradient-primary px-3 rounded-pill">Released</span>
                            <?php// else: ?>
                                <?php// if($row['status'] == 1): ?>
                                    <span class="badge badge-success bg-gradient-success px-3 rounded-pill">Active</span>
                                <?php// else: ?>
                                    <span class="badge badge-danger bg-gradient-danger px-3 rounded-pill">Inactive</span>
                                <?php// endif; ?>
                             <?php// endif; ?>
                            </td>
							<td align="center">
								 <button type="button" class="btn btn-flat p-1 btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
				                  		Action
				                    <span class="sr-only">Toggle Dropdown</span>
				                  </button>
				                  <div class="dropdown-menu" role="menu">
				                    <a class="dropdown-item view-data" href="./?page=inmates/view_inmate&id=<?php //echo $row['id'] ?>"><span class="fa fa-eye text-dark"></span> View</a>
				                    <div class="dropdown-divider"></div>
				                    <a class="dropdown-item edit-data" href="./?page=inmates/manage_inmate&id=<?php //echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
				                    <div class="dropdown-divider"></div>
				                    <a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php// echo $row['id'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
				                  </div>
							</td>
						</tr>
					<?php// endwhile; ?>