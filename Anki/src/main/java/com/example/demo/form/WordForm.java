package com.example.demo.form;

import jakarta.validation.constraints.NotEmpty;
import jakarta.validation.constraints.Pattern;
import lombok.AllArgsConstructor;
import lombok.Data;
import lombok.NoArgsConstructor;

@Data
@AllArgsConstructor
@NoArgsConstructor
public class WordForm {
//	@NotEmpty
	private Integer id;
	
	@NotEmpty
	@Pattern(regexp = "^[a-zA-Z ]*$")
	private String worden;
	
	@NotEmpty
	private String wordjp;
	
//	@NotEmpty
	private Integer misscount;
}
