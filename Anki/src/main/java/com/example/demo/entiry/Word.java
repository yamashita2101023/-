package com.example.demo.entiry;

import org.springframework.data.annotation.Id;

import lombok.AllArgsConstructor;
import lombok.Data;
import lombok.NoArgsConstructor;
@Data
@AllArgsConstructor
@NoArgsConstructor
public class Word {
	@Id
	private Integer id;
	private String worden;
	private String wordjp;
	private Integer misscount;
}
