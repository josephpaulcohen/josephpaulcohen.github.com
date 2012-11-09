package jeocohen;

import java.awt.Color;
import java.awt.image.BufferedImage;
import java.io.File;
import java.io.IOException;

import javax.imageio.ImageIO;

public class ImageDiff {

	public static void main(String[] args) throws IOException {
		
		String[] argsnew = {"1.png","2.png","diff.png"};
		
		args = argsnew;
		
		if (args.length != 3){
			System.out.println("Usage: imagediff <file1> <file2> <outputfile>");
			return;
		}
		
		BufferedImage one = ImageIO.read(new File(args[0]));
		BufferedImage two = ImageIO.read(new File(args[1]));
		
		System.out.println(one.toString());
		System.out.println(two.toString());
		
		if (one.getHeight() != two.getHeight() ||
				one.getWidth() != two.getWidth()){
			System.out.println("Images are different sizes");
			return;
		}
		
		BufferedImage diff = new BufferedImage(one.getWidth(), one.getHeight(), one.getType());
		
		for(int x = 0; x <= one.getWidth()-1; x++)
			for(int y = 0; y <= one.getHeight()-1; y++){
				
				int rgb_1 = one.getRGB(x, y);
				int rgb_2 = two.getRGB(x, y);
				
				Color c_1 = new Color(rgb_1);
				Color c_2 = new Color(rgb_2);
				
				int r = Math.abs(c_1.getRed() - c_2.getRed());
				int g = Math.abs(c_1.getGreen() - c_2.getGreen());
				int b = Math.abs(c_1.getBlue() - c_2.getBlue());
				
				
				
				int rgb_raw = new Color(r, g, b).getRGB();
				
				//int rgb = Math.abs(rgb_raw);
				
				diff.setRGB(x, y, rgb_raw);
				
			}
			
		File out = new File(args[2]);
		
		if (ImageIO.write(diff, "png", out))
			System.out.println("Diff written to " + out.getAbsolutePath());
		else
			System.out.println("Error");
		

	}

}
