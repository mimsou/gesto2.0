import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { BootmenuComponent } from './bootmenu.component';

describe('BootmenuComponent', () => {
  let component: BootmenuComponent;
  let fixture: ComponentFixture<BootmenuComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ BootmenuComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(BootmenuComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
